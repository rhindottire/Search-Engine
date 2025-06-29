import json, sys, os, logging, time, hashlib, re
from adalflow.components.retriever import BM25Retriever
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
from Sastrawi.StopWordRemover.StopWordRemoverFactory import StopWordRemoverFactory
from multiprocessing import Pool, cpu_count
from collections import Counter

# Setup logging
logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s - %(levelname)s - %(message)s',
    handlers=[
        logging.FileHandler('data/UAS/log/preprocessing.log'),
        logging.StreamHandler()
    ]
)
logger = logging.getLogger(__name__)
logging.getLogger('adalflow').setLevel(logging.WARNING)  # Suppress adalflow INFO logs

# Synonym Expansion
SYNONYM_DICT = {
    "kebudayaan": ["budaya", "kultur"],
    "nasional": ["negara"],
    "budaya": ["kebudayaan", "kultur"],
    "kultur": ["kebudayaan", "budaya"],
    "negara": ["nasional"]
}

# Query untuk tuning BM25
TUNING_QUERIES = [
    "kebudayaan nasional",
    "festival budaya",
    "teknologi Indonesia",
    "seni tradisional",
    "sejarah Indonesia",
    "Perkembangan kebudayaan nasional di Indonesia pada abad ke-21.",
    "Bagaimana festival budaya memengaruhi pariwisata di Indonesia.",
    "Inovasi teknologi di Indonesia untuk mendukung pelestarian budaya.",
    "Seni tradisional Jawa dan pengaruhnya terhadap identitas nasional.",
    "Sejarah kemerdekaan Indonesia dan peran tokoh nasional dalam budaya."
]

def get_file_hash(file_path):
    try:
        with open(file_path, 'rb') as f:
            return hashlib.md5(f.read()).hexdigest()
    except FileNotFoundError:
        return None

def preprocess_text(text, log_terms=False):
    start_time = time.time()
    try:
        stemmer = StemmerFactory().create_stemmer()                            # Tokenization
        stopword_remover = StopWordRemoverFactory().create_stop_word_remover() # Stopword Removal
        initial_word_count = len(text.split())  # Hitung kata awal
        text = text.lower()                     # Lowercasing
        text = re.sub(r'[^\w\s]', '', text)     # Punctuation Removal (reduce noise)
        # Number Removal: Hanya hapus angka yang bukan tahun (4 digit) untuk mendukung query dengan tanggal/tahun.
        numbers_removed = re.findall(r'\b\d{1,3}\b|\b\d{5,}\b', text)
        years_kept = re.findall(r'\b\d{4}\b', text)
        text = re.sub(r'\b\d{1,3}\b|\b\d{5,}\b', '', text)
        text = ' '.join(text.split())        # Whitespace Normalization
        text = stemmer.stem(text)            # Stemming
        text = stopword_remover.remove(text) # Stopword Removal

        # Lemmatization: Tidak diterapkan, karena Sastrawi hanya mendukung stemming.
        # Untuk bahasa Indonesia, stemming cukup karena lemmatization tidak memberikan keuntungan signifikan.
        # Spelling Correction: Tidak diterapkan, karena tidak ada library standar untuk bahasa Indonesia.
        # Dataset Wikipedia bersih dari kesalahan ejaan.

        # Synonym Expansion: Menambahkan sinonim ke teks untuk meningkatkan recall.
        words = text.split()
        expanded_words = []
        for word in words:
            expanded_words.append(word)
            if word in SYNONYM_DICT:
                expanded_words.extend(SYNONYM_DICT[word])
        text = ' '.join(expanded_words)

        if log_terms:
            terms = text.split()
            term_freq = Counter(terms)
            logger.info(f"Term hasil preprocessing: {term_freq}")

        elapsed = time.time() - start_time
        minutes = elapsed / 60
        final_word_count = len(text.split())
        if elapsed > 1:
            logger.info(f"Preprocessing selesai: Kata awal={initial_word_count}, Kata akhir={final_word_count}, Angka dihapus={numbers_removed}, Tahun dipertahankan={years_kept}, Waktu={minutes:.2f} menit ({elapsed:.2f} detik)")
        return text
    except Exception as e:
        logger.error(f"Error dalam preprocessing: {str(e)}")
        return ""

def detect_phrase(content, query):
    content_lower = content.lower()
    query_terms = query.lower().split()
    if len(query_terms) < 2:
        return 0
    for i in range(len(content_lower.split()) - len(query_terms) + 1):
        window = ' '.join(content_lower.split()[i:i+len(query_terms)])
        if query.lower() in window:
            logger.info(f"Frase eksak '{query}' ditemukan di konten")
            return 0.5  # Bobot lebih rendah untuk frase eksak
        if all(term in window for term in query_terms):
            logger.info(f"Kedekatan kata {query_terms} ditemukan di konten")
            return 1.0  # Bobot untuk kedekatan
    return 0

def generate_snippet(content, query, max_length=100):
    try:
        processed_query = preprocess_text(query)
        query_terms = processed_query.split()
        content_lower = content.lower()
        snippet = ""
        for term in query_terms:
            if term in content_lower:
                start = max(0, content_lower.index(term) - 20)
                end = start + max_length
                snippet = content[start:end]
                snippet = re.sub(f"\\b{term}\\b", f"**{term}**", snippet, flags=re.IGNORECASE)
                break
        if not snippet:
            snippet = content[:max_length]
        if len(snippet) > max_length:
            snippet = snippet[:max_length-3] + "..."
        for term in query_terms:
            if term not in content_lower:
                snippet = re.sub(f"\\b{term}\b", f"~~kata~~", snippet, flags=re.IGNORECASE)
        logger.info(f"Snippet untuk query '{query}': {snippet}")
        return snippet
    except Exception as e:
        logger.error(f"Error membuat snippet: {str(e)}")
        return content[:max_length-3] + "..."

def preprocess_article(item):
    doc = preprocess_text(item['content'], log_terms=True)
    return {
        "id": item["id"],
        "title": item["title"],
        "content": item["content"],
        "category": item.get("category", "Tidak diketahui"),
        "image_url": item.get("image_url", "no_image"),
        "source_url": item.get("source_url", ""),
        "date": item.get("date", "Tidak diketahui"),
        "preprocessed": doc
    }

def load_dataset(file_path='data/UAS/articles.json', cache_path='data/UAS/preprocessed.json'):
    start_time = time.time()
    logger.info(f"Memuat dataset dari {file_path}")

    file_hash = get_file_hash(file_path)
    cache_valid = False
    if os.path.exists(cache_path):
        try:
            with open(cache_path, 'r', encoding='utf-8') as f:
                cached_data = json.load(f)
            cached_hash = cached_data[0].get('file_hash') if cached_data else None
            if cached_hash == file_hash:
                cache_valid = True
                logger.info(f"Menggunakan cache preprocessing dari {cache_path}")
                data = [{"id": item["id"], "title": item["title"], "content": item["content"],
                         "category": item["category"], "image_url": item["image_url"],
                         "source_url": item["source_url"], "date": item["date"]} for item in cached_data]
                documents = [item['preprocessed'] for item in cached_data]
                elapsed = time.time() - start_time
                minutes = elapsed / 60
                logger.info(f"Cache dimuat: {len(data)} dokumen, Waktu={minutes:.2f} menit ({elapsed:.2f} detik)")
                logger.info(f"Dokumen di indeks: {[item['id'] for item in cached_data]}")
                return data, documents
        except Exception as e:
            logger.error(f"Error memuat cache: {str(e)}")

    try:
        with open(file_path, 'r', encoding='utf-8') as f:
            data = json.load(f)
        logger.info(f"Dataset dimuat, memproses {len(data)} artikel...")

        with Pool(processes=cpu_count()) as pool:
            cached_data = pool.map(preprocess_article, data)
            documents = [item['preprocessed'] for item in cached_data]

        cached_data = [{"file_hash": file_hash, **item} for item in cached_data]
        with open(cache_path, 'w', encoding='utf-8') as f:
            json.dump(cached_data, f, ensure_ascii=False)
        elapsed = time.time() - start_time
        minutes = elapsed / 60
        logger.info(f"Cache disimpan di {cache_path}: {len(cached_data)} dokumen, Waktu={minutes:.2f} menit ({elapsed:.2f} detik)")
        logger.info(f"Dokumen di indeks: {[item['id'] for item in cached_data]}")

        data = [{"id": item["id"], "title": item["title"], "content": item["content"],
                 "category": item["category"], "image_url": item["image_url"],
                 "source_url": item["source_url"], "date": item["date"]} for item in cached_data]
        return data, documents
    except FileNotFoundError:
        logger.error(f"File {file_path} tidak ditemukan")
        return [], []
    except Exception as e:
        logger.error(f"Error memuat dataset: {str(e)}")
        return [], []

def load_best_params(file_hash, cache_path='data/UAS/bm25_params.json'):
    try:
        if os.path.exists(cache_path):
            with open(cache_path, 'r') as f:
                cached = json.load(f)
            if cached.get('file_hash') == file_hash:
                logger.info(f"Memuat best_b={cached['best_b']}, best_k1={cached.get('best_k1', 1.2)}, best_delta={cached.get('best_delta', 0)} dari {cache_path}")
                return cached.get('best_b', 0.5), cached.get('best_k1', 1.2), cached.get('best_delta', 0)
        return None, None, None
    except Exception as e:
        logger.error(f"Error memuat cache params: {str(e)}")
        return None, None, None

def tune_bm25(
            documents,
            b_values=[0.5, 0.75],
            k1_values=[1.2],
            delta_values=[0],
            file_hash=None
        ):
    best_b, best_k1, best_delta = 0.5, 1.2, 0
    best_avg_score = 0
    for b in b_values:
        for k1 in k1_values:
            for delta in delta_values:
                try:
                    retriever = BM25Retriever(documents=documents, b=b, k1=k1)
                    total_avg_score = 0
                    for query in TUNING_QUERIES:
                        processed_query = preprocess_text(query, log_terms=True)
                        result = retriever(processed_query)
                        if result and hasattr(result[0], 'doc_indices') and hasattr(result[0], 'doc_scores'):
                            top_indices = result[0].doc_indices[:10]
                            top_scores = result[0].doc_scores[:10]
                            avg_score = sum(top_scores) / len(top_scores) if top_scores else 0
                            unique_docs = len(set(top_indices))
                            logger.info(f"Tuning BM25 untuk query '{query}': b={b}, k1={k1}, delta={delta}, Indeks={top_indices}, Skor={top_scores}, Skor rata-rata={avg_score:.2f}, Dokumen unik={unique_docs}")
                            total_avg_score += avg_score
                    total_avg_score /= len(TUNING_QUERIES)
                    logger.info(f"Rata-rata skor semua query: b={b}, k1={k1}, delta={delta}, Skor rata-rata={total_avg_score:.2f}")
                    if total_avg_score > best_avg_score:
                        best_avg_score = total_avg_score
                        best_b, best_k1, best_delta = b, k1, delta
                except Exception as e:
                    logger.error(f"Error tuning b={b}, k1={k1}, delta={delta}: {str(e)}")
    logger.info(f"Parameter terbaik: b={best_b}, k1={best_k1}, delta={best_delta}, Skor rata-rata semua query={best_avg_score:.2f}")
    if file_hash:
        try:
            with open('data/UAS/bm25_params.json', 'w') as f:
                json.dump({'file_hash': file_hash, 'best_b': best_b, 'best_k1': best_k1, 'best_delta': best_delta}, f)
            logger.info(f"Best_b={best_b}, best_k1={best_k1}, best_delta={best_delta} disimpan ke data/UAS/bm25_params.json")
        except Exception as e:
            logger.error(f"Error menyimpan params: {str(e)}")
    return best_b, best_k1, best_delta

def search(query, dataset_file='data/UAS/articles.json'):
    start_time = time.time()
    logger.info(f"Memulai pencarian untuk query: {query}")

    data, documents = load_dataset(dataset_file)
    if not data:
        logger.warning("Dataset kosong, mengembalikan hasil kosong")
        return []

    try:
        file_hash = get_file_hash(dataset_file)
        best_b, best_k1, best_delta = load_best_params(file_hash)
        if best_b is None:
            logger.info("Tuning parameter b, k1, dan delta karena cache tidak ditemukan atau dataset berubah")
            best_b, best_k1, best_delta = tune_bm25(documents, file_hash=file_hash)
        
        logger.info(f"Inisialisasi BM25Retriever dengan b={best_b}, k1={best_k1}, delta={best_delta}")
        retriever = BM25Retriever(documents=documents, b=best_b, k1=best_k1)
        processed_query = preprocess_text(query, log_terms=True)
        logger.info(f"Query setelah preprocessing: {processed_query}")
        results = retriever(processed_query)

        if not results or not hasattr(results[0], 'doc_indices') or not hasattr(results[0], 'doc_scores'):
            logger.warning("Tidak ada doc_indices atau doc_scores dalam hasil BM25")
            return []

        top_indices = results[0].doc_indices[:10]
        top_scores = results[0].doc_scores[:10]
        # Tambah bobot phrase matching dan delta untuk semua dokumen di top_indices
        for idx in top_indices:
            if idx < len(data):
                phrase_score = detect_phrase(data[idx]["content"], query)
                top_scores[top_indices.index(idx)] += phrase_score + best_delta
                logger.info(f"ID {data[idx]['id']}: Phrase score={phrase_score:.2f}, Delta={best_delta:.2f}, Total score={top_scores[top_indices.index(idx)]:.2f}")

        # Urutkan ulang berdasarkan skor baru
        sorted_results = sorted(zip(top_indices, top_scores), key=lambda x: x[1], reverse=True)
        top_indices = [idx for idx, _ in sorted_results[:10]]
        top_scores = [score for _, score in sorted_results[:10]]

        logger.info(f"Indeks teratas: {top_indices}")
        logger.info(f"Skor relevansi: {top_scores}")
        logger.info(f"Distribusi skor top-10: min={min(top_scores):.2f}, max={max(top_scores):.2f}, rata-rata={sum(top_scores)/len(top_scores):.2f}")
        logger.info("Catatan: score_normalized adalah skor relatif terhadap dokumen dengan skor tertinggi, bukan kecocokan absolut dengan query.")

        output = []
        max_score = max(top_scores) if top_scores else 1.0
        for i, score in zip(top_indices, top_scores):
            if i < len(data):
                if data[i]["id"] != i + 1:
                    logger.warning(f"Offset ID terdeteksi: indeks {i} tidak sesuai dengan id {data[i]['id']}")
                snippet = generate_snippet(data[i]["content"], query)
                output.append({
                    "id": data[i]["id"],
                    "title": data[i]["title"],
                    "content": data[i]["content"],
                    "snippet": snippet,
                    "score": float(score),
                    "score_normalized": float(score / max_score) if max_score else 0.0,
                    "category": data[i]["category"],
                    "image_url": data[i]["image_url"],
                    "source_url": data[i]["source_url"],
                    "date": data[i]["date"]
                })
                logger.info(f"Hasil ID {data[i]['id']}: raw={score:.2f}, normalized={score/max_score:.2f}")

        # Filter dokumen dengan score_normalized >= 0.8
        output = [doc for doc in output if doc["score_normalized"] >= 0.8]
        elapsed = time.time() - start_time
        minutes = elapsed / 60
        logger.info(f"Mengembalikan {len(output)} dokumen dengan score_normalized >= 0.8")
        logger.info(f"Pencarian selesai: {len(output)} hasil, Waktu={minutes:.2f} menit ({elapsed:.2f} detik)")
        return output
    except Exception as e:
        logger.error(f"Error dalam pencarian: {str(e)}")
        return []

if __name__ == "__main__":
    query = sys.argv[1] if len(sys.argv) > 1 else "kebudayaan nasional"
    results = search(query)
    sys.stdout.buffer.write(json.dumps(results, ensure_ascii=False).encode('utf-8'))