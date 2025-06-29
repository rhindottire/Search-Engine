import re
import sys
import json
import pickle
import io

sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')

if len(sys.argv) != 4:
    print("\nPenggunaan:\n\tpython query.py [indexDB] [jumlah_output] [query]\n")
    sys.exit(1)

index_file_path = sys.argv[1]
top_n = int(sys.argv[2])
raw_query = sys.argv[3].lower()

# Load TF-IDF index
with open(index_file_path, 'rb') as f:
    tf_idf_index = pickle.load(f)

def clean_text(text):
    text = (text.encode('ascii', 'ignore')).decode('utf-8')
    text = re.sub(r"[^\w\s]", " ", text)
    text = re.sub(r"\s+", " ", text)
    return text.strip().lower()
cleaned_query = clean_text(raw_query)
query_words = cleaned_query.split()

document_scores = {}

# Query Matching & Retrieval
if cleaned_query in tf_idf_index:
    for doc in tf_idf_index[cleaned_query]:
        doc_id = doc['doc_id']
        document_scores[doc_id] = doc.copy()
        document_scores[doc_id]['score'] += 1
else:
    for q in query_words:
        if q in tf_idf_index:
            for doc in tf_idf_index[q]:
                doc_id = doc['doc_id']
                if doc_id in document_scores:
                    # Scoring
                    document_scores[doc_id]['score'] += doc['score']
                else:
                    document_scores[doc_id] = doc.copy()
        else:
            continue

# Ranking
result_docs = list(document_scores.values())
result_docs.sort(key=lambda d: d['score'], reverse=True)

# Print hasil
for i, doc in enumerate(result_docs[:top_n]):
    print(json.dumps(doc, ensure_ascii=False))