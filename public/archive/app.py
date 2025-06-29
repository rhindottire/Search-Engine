import gradio as gr
import logging
import json
import pandas as pd
from test_adalflow import search  # Impor fungsi search dari test_adalflow.py

# Setup logging
logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s - %(levelname)s - %(message)s',
    handlers=[
        logging.FileHandler('gradio_app.log'),
        logging.StreamHandler()
    ]
)
logger = logging.getLogger(__name__)

def search_interface(query):
    try:
        results = search(query)
        logger.info(f"Hasil pencarian untuk query '{query}': {results}")
        
        if not results:
            return [], "Tidak ada hasil ditemukan atau terjadi error."
        
        max_results = 10
        results = results[:max_results]
        


        formatted_results = pd.DataFrame([
            {
                "ID": item["id"],
                "Title": item["title"],
                "Content": item["content"][:200] + "..." if len(item["content"]) > 200 else item["content"],
                "Score": item["score"]
            }
            for item in results
        ])


        # Simpan hasil ke file JSON
        try:
            with open("hasil_pencarian.json", "w", encoding="utf-8") as f:
                json.dump(formatted_results, f, ensure_ascii=False, indent=4)
        except Exception as write_err:
            logger.warning(f"Gagal menyimpan hasil ke file: {str(write_err)}")

        message = f"Pencarian selesai, ditemukan {len(results)} hasil. Disimpan ke 'hasil_pencarian.json'."
        return formatted_results, message
    except Exception as e:
        logger.error(f"Error dalam search_interface: {str(e)}")
        return [], f"Error: {str(e)}"

with gr.Blocks() as demo:
    gr.Markdown("# Aplikasi Pencarian Artikel")
    gr.Markdown("Masukkan kueri pencarian untuk menemukan artikel terkait.")
    
    with gr.Row():
        query_input = gr.Textbox(label="Kueri Pencarian", placeholder="Masukkan kueri, misalnya 'kebudayaan nasional'")
        search_button = gr.Button("Cari")
    
    output_table = gr.Dataframe(
        label="Hasil Pencarian",
        headers=["ID", "Title", "Content", "Score"],
        wrap=True
    )
    status_message = gr.Textbox(label="Status")
    
    search_button.click(
        fn=search_interface,
        inputs=query_input,
        outputs=[output_table, status_message]
    )

if __name__ == "__main__":
    demo.launch()
