import wikipediaapi, json, csv, logging, time, requests
from urllib.parse import quote

# Setup logging
logging.basicConfig(
    level=logging.INFO,
    format='%(asctime)s - %(levelname)s - %(message)s',
    handlers=[
        logging.FileHandler('data/UAS/log/scraping.log'),
        logging.StreamHandler()
    ]
)
logger = logging.getLogger(__name__)

def validate_image_url(url, timeout=2):
    """Validasi URL gambar dengan HTTP head request."""
    try:
        response = requests.head(url, timeout=timeout)
        return url if response.status_code == 200 else "default_culture.jpg"
    except requests.RequestException as e:
        logger.warning(f"Image validation failed for {url}: {str(e)}")
        return "default_culture.jpg"

def get_image_url(title, wiki_api_url="https://id.wikipedia.org/w/api.php"):
    """Ambil image_url via MediaWiki API jika page.images gagal."""
    try:
        params = {
            "action": "query",
            "format": "json",
            "titles": title,
            "prop": "images",
            "imlimit": 1
        }
        response = requests.get(wiki_api_url, params=params, timeout=5)
        data = response.json()
        pages = data.get("query", {}).get("pages", {})
        for page_id, page_data in pages.items():
            images = page_data.get("images", [])
            if images:
                image_title = images[0].get("title")
                image_params = {
                    "action": "query",
                    "format": "json",
                    "titles": image_title,
                    "prop": "imageinfo",
                    "iiprop": "url"
                }
                image_response = requests.get(wiki_api_url, params=image_params, timeout=5)
                image_data = image_response.json()
                for img_page_id, img_page_data in image_data.get("query", {}).get("pages", {}).items():
                    url = img_page_data.get("imageinfo", [{}])[0].get("url")
                    if url:
                        return validate_image_url(url)
        return "default_culture.jpg"
    except Exception as e:
        logger.warning(f"MediaWiki API failed for image {title}: {str(e)}")
        return "default_culture.jpg"

def get_revision_date(title, wiki_api_url="https://id.wikipedia.org/w/api.php"):
    """Ambil revision date via MediaWiki API."""
    try:
        params = {
            "action": "query",
            "format": "json",
            "titles": title,
            "prop": "revisions",
            "rvprop": "timestamp",
            "rvlimit": 1
        }
        response = requests.get(wiki_api_url, params=params, timeout=5)
        data = response.json()
        pages = data.get("query", {}).get("pages", {})
        for page_id, page_data in pages.items():
            revisions = page_data.get("revisions", [])
            if revisions:
                return revisions[0].get("timestamp", "Tidak diketahui")
        return "Tidak diketahui"
    except Exception as e:
        logger.warning(f"MediaWiki API failed for revision date {title}: {str(e)}")
        return "Tidak diketahui"

def scrape_wikipedia(category, max_articles=500, max_time=900):
    """Scrape artikel dari kategori Wikipedia, batasi waktu dan jumlah artikel."""
    start_time = time.time()
    user_agent = "UAS-IR-Project/1.0 (https://github.com/rhindottire/Search-Engine; achmadaliridho46@gmail.com)"
    wiki = wikipediaapi.Wikipedia(user_agent=user_agent, language='id')

    # Cek atribut tersedia
    test_page = wiki.page("Otonan")
    available_attrs = {
        "images": hasattr(test_page, 'images') and bool(test_page.images),
        "url": hasattr(test_page, 'url'),
        "revision_date": hasattr(test_page, 'revision_date'),
        "categories": hasattr(test_page, 'categories') and bool(test_page.categories)
    }
    logger.info(f"Available attributes: images={available_attrs['images']}, url={available_attrs['url']}, revision_date={available_attrs['revision_date']}, categories={available_attrs['categories']}")

    logger.info(f"Memulai scraping untuk kategori: {category}, target: {max_articles} artikel, max waktu: {max_time} detik")
    cat = wiki.page(f"Kategori:{category}")
    articles = []
    id_counter = 1
    image_url_failed = 0
    date_failed = 0
    category_failed = 0
    source_url_failed = 0

    for page in cat.categorymembers.values():
        if time.time() - start_time > max_time:
            logger.warning(f"Waktu scraping melebihi {max_time} detik, menghentikan di {id_counter-1} artikel")
            break
        if page.ns != 0 or id_counter > max_articles:
            continue
        try:
            text = page.text
            if not text:
                logger.warning(f"Artikel kosong: {page.title}")
                continue
            categories = list(page.categories.keys()) if hasattr(page, 'categories') else []
            if not categories:
                logger.warning(f"No categories for {page.title}, using Tidak diketahui")
                category_failed += 1
            image_url = "default_culture.jpg"
            if hasattr(page, 'images') and page.images:
                image_url = validate_image_url(page.images[0])
            else:
                image_url = get_image_url(page.title)
            if image_url == "default_culture.jpg":
                logger.warning(f"No image for {page.title}, using default_culture.jpg")
                image_url_failed += 1
            source_url = f"https://id.wikipedia.org/wiki/{quote(page.title)}"
            if not source_url.startswith("https://id.wikipedia.org/wiki/"):
                logger.warning(f"No source URL for {page.title}, using constructed URL")
                source_url_failed += 1
            revision_date = get_revision_date(page.title)
            if revision_date == "Tidak diketahui":
                logger.warning(f"No revision date for {page.title}, using Tidak diketahui")
                date_failed += 1

            articles.append({
                "id": id_counter,
                "title": page.title,
                "content": text,
                "category": "|".join(categories) if categories else "Tidak diketahui",
                "image_url": image_url,
                "source_url": source_url,
                "date": str(revision_date) if revision_date != "Tidak diketahui" else "Tidak diketahui"
            })
            logger.info(f"Scraped article: {page.title}, ID: {id_counter}")
            id_counter += 1
            time.sleep(0.3)  # Rate limit
        except Exception as e:
            logger.error(f"Gagal scrape {page.title}: {str(e)}")

    if len(articles) < 250:
        logger.warning(f"Scraping hanya menghasilkan {len(articles)} artikel, kurang dari minimum 250")

    # Log summary kegagalan
    logger.info(f"Summary: {image_url_failed} image_url failed, {date_failed} date failed, {category_failed} category failed, {source_url_failed} source_url failed")
    
    # Simpan ke JSON
    with open('data/UAS/articles.json', 'w', encoding='utf-8') as f:
        json.dump(articles, f, ensure_ascii=False, indent=2)
    logger.info(f"Disimpan {len(articles)} artikel ke data/UAS/articles.json")

    # Simpan ke CSV
    with open('data/UAS/articles.csv', 'w', encoding='utf-8', newline='') as f:
        writer = csv.DictWriter(f, fieldnames=['id', 'title', 'content', 'category', 'image_url', 'source_url', 'date'])
        writer.writeheader()
        writer.writerows(articles)
    logger.info(f"Disimpan {len(articles)} artikel ke data/UAS/articles.csv")

    elapsed = time.time() - start_time
    logger.info(f"Scraping selesai dalam {elapsed:.2f} detik, {len(articles)} artikel")
    return articles

if __name__ == "__main__":
    scrape_wikipedia("Budaya Indonesia", max_articles=500, max_time=900)