# import sys
# print(sys.path)
# import sys
# print("Python executable:", sys.executable)
# from adalflow.components.retriever import BM25Retriever
# print(BM25Retriever)

import json
import sys
import os
import logging
import time
import hashlib
from adalflow.components.retriever import BM25Retriever
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
from Sastrawi.StopWordRemover.StopWordRemoverFactory import StopWordRemoverFactory
import re
from multiprocessing import Pool, cpu_count

# Setup logging
logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s - %(levelname)s - %(message)s',
    handlers=[
        logging.FileHandler('search_engine.log'),
        logging.StreamHandler()
    ]
)
logger = logging.getLogger(__name__)

def get_file_hash(file_path):
    """Hitung hash MD5 dari file untuk deteksi perubahan."""
    try:
        with open(file_path, 'rb') as f:
            return hashlib.md5(f.read()).hexdigest()
    except FileNotFoundError:
        return None

def preprocess_text(text):
    """Preprocess teks dengan stemming dan stopword removal."""
    start_time = time.time()
    try:
        stemmer = StemmerFactory().create_stemmer()
        stopword_remover = StopWordRemoverFactory().create_stop_word_remover()
        text = text.lower()
        text = re.sub(r'[^\w\s]', '', text)
        text = stopword_remover.remove(stemmer.stem(text))
        elapsed = time.time() - start_time
        if elapsed > 1:  # Log hanya untuk preprocessing > 1 detik
            logger.info(f"Preprocessing selesai dalam {elapsed:.2f} detik")
        return text
    except Exception as e:
        logger.error(f"Error dalam preprocessing: {str(e)}")
        return ""

def preprocess_article(item):
    """Preprocess satu artikel untuk multiprocessing."""
    doc = preprocess_text(item['content'])
    return {"id": item["id"], "title": item["title"], "content": item["content"], "preprocessed": doc}

def load_dataset(file_path='articles.json', cache_path='preprocessed_articles.json'):
    """Load dataset dan cache dokumen yang sudah dipreproses."""
    start_time = time.time()
    logger.info(f"Memuat dataset dari {file_path}")
    
    # Cek apakah cache valid
    file_hash = get_file_hash(file_path)
    cache_valid = False
    if os.path.exists(cache_path):
        try:
            with open(cache_path, 'r', encoding='utf-8') as f:
                cached_data = json.load(f)
            cached_hash = cached_data[0].get('file_hash') if cached_data else None
            if cached_hash == file_hash:
                cache_valid = True
                logger.info(f"Cache valid ditemukan di {cache_path}, memuat...")
                data = [{"id": item["id"], "title": item["title"], "content": item["content"]} for item in cached_data]
                documents = [item['preprocessed'] for item in cached_data]
                logger.info(f"Cache dimuat dalam {time.time() - start_time:.2f} detik")
                return data, documents
        except Exception as e:
            logger.error(f"Error memuat cache: {str(e)}")
    
    # Load dan preprocess dataset
    try:
        with open(file_path, 'r', encoding='utf-8') as f:
            data = json.load(f)
        logger.info(f"Dataset dimuat, memproses {len(data)} artikel...")
        
        # Gunakan multiprocessing untuk preprocessing
        with Pool(processes=cpu_count()) as pool:
            cached_data = pool.map(preprocess_article, data)
            documents = [item['preprocessed'] for item in cached_data]
        
        # Tambahkan file_hash ke cache
        cached_data = [{"file_hash": file_hash, **item} for item in cached_data]
        
        # Simpan ke cache
        with open(cache_path, 'w', encoding='utf-8') as f:
            json.dump(cached_data, f, ensure_ascii=False)
        logger.info(f"Cache disimpan di {cache_path} dalam {time.time() - start_time:.2f} detik")
        
        data = [{"id": item["id"], "title": item["title"], "content": item["content"]} for item in cached_data]
        return data, documents
    except FileNotFoundError:
        logger.error(f"File {file_path} tidak ditemukan")
        return [], []
    except Exception as e:
        logger.error(f"Error memuat dataset: {str(e)}")
        return [], []

def search(query, dataset_file='articles.json'):
    """Cari artikel berdasarkan query menggunakan BM25."""
    start_time = time.time()
    logger.info(f"Memulai pencarian untuk query: {query}")
    
    data, documents = load_dataset(dataset_file)
    if not data:
        logger.warning("Dataset kosong, mengembalikan hasil kosong")
        return []
    
    try:
        logger.info("Inisialisasi BM25Retriever...")
        retriever = BM25Retriever(documents=documents)
        processed_query = preprocess_text(query)
        results = retriever(processed_query)
        
        # Debugging output
        logger.info(f"Struktur hasil BM25: {type(results)}")
        if results:
            logger.info(f"Item pertama: {results[0]}")
        
        # Ambil doc_indices dan doc_scores
        if results and hasattr(results[0], 'doc_indices') and hasattr(results[0], 'doc_scores'):
            top_indices = results[0].doc_indices[:10]
            top_scores = results[0].doc_scores[:10]
            logger.info(f"Indeks teratas: {top_indices}")
            logger.info(f"Skor relevansi: {top_scores}")
            
            # Verifikasi ID
            output = []
            for i, score in zip(top_indices, top_scores):
                if i < len(data):
                    if data[i]["id"] != i + 1:  # Asumsi id dimulai dari 1
                        logger.warning(f"Offset ID terdeteksi: indeks {i} tidak sesuai dengan id {data[i]['id']}")
                    output.append({
                        "id": data[i]["id"],
                        "title": data[i]["title"],
                        "content": data[i]["content"],
                        "score": float(score)  # Konversi ke float untuk JSON
                    })
        else:
            logger.warning("Tidak ada doc_indices atau doc_scores dalam hasil BM25")
            output = []
        
        logger.info(f"Pencarian selesai dalam {time.time() - start_time:.2f} detik, ditemukan {len(output)} hasil")
        return output
    except Exception as e:
        logger.error(f"Error dalam pencarian: {str(e)}")
        return []

if __name__ == "__main__":
    query = sys.argv[1] if len(sys.argv) > 1 else "kebudayaan nasional"
    results = search(query)
    # print(json.dumps(results, ensure_ascii=False))
    sys.stdout.buffer.write(json.dumps(results, ensure_ascii=False).encode('utf-8'))