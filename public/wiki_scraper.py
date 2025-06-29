import wikipediaapi, json, csv

def scrape_wikipedia(category, max_articles=200):
    # Tambahkan User-Agent sesuai kebijakan Wikipedia
    user_agent = "UAS-IR-Project/1.0 (https://github.com/rhindottire/Search-Engine; achmadaliridho46@gmail.com)"
    wiki = wikipediaapi.Wikipedia(user_agent=user_agent, language='id')
    cat = wiki.page(f"Kategori:{category}")
    articles = []
    id_counter = 1

    for page in cat.categorymembers.values():
        if page.ns == 0 and id_counter <= max_articles:  # Hanya artikel (bukan subkategori)
            text = page.text
            if text:  # Pastikan artikel tidak kosong
                articles.append({
                    "id": id_counter,
                    "title": page.title,
                    "content": text
                })
                id_counter += 1
                print(f"Scraped article: {page.title}")

    # Simpan ke JSON
    with open('data/UAS/articles.json', 'w', encoding='utf-8') as f:
        json.dump(articles, f, ensure_ascii=False, indent=2)

    # Simpan ke CSV
    with open('data/UAS/articles.csv', 'w', encoding='utf-8', newline='') as f:
        writer = csv.DictWriter(f, fieldnames=['id', 'title', 'content'])
        writer.writeheader()
        writer.writerows(articles)

    return articles

if __name__ == "__main__":
    scrape_wikipedia("Budaya Indonesia", max_articles=200)