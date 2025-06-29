<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller {
    
    public function query(Request $request) {
        $query = $request->input('query', 'kebudayaan nasional');

        // Path ke python dari virtual environment
        $pythonBin = base_path('.venv/Scripts/python.exe');
        $pythonScript = base_path('public/test_adalflow.py');

        // Escape argumen dengan aman
        $escapedQuery = escapeshellarg($query);
        $command = "\"{$pythonBin}\" \"{$pythonScript}\" {$escapedQuery}";

        // Jalankan command dan tangkap stderr juga
        $output = shell_exec($command);

        // Debug output Python
        if (empty($output)) {
            Log::error("Python script returned empty output");
        }

        $data = json_decode($output, true) ?? [];

        // Log jika decoding gagal atau kosong
        if (empty($data) && !empty($output)) {
            Log::error("Python script output: " . $output);
        }

        return view('search', [
            'data' => $data,
            'query' => $query
        ]);
    }

    public function detail($id) {
        // Load artikel dari JSON berdasarkan ID
        $articlesPath = base_path('public/data/UAS/articles.json');

        if (!file_exists($articlesPath)) {
            abort(404, 'Data artikel tidak ditemukan');
        }

        $articles = json_decode(file_get_contents($articlesPath), true);
        $article = collect($articles)->firstWhere('id', (int)$id);

        if (!$article) {
            abort(404, 'Artikel tidak ditemukan');
        }

        // Get related articles (same category or similar title)
        $relatedArticles = collect($articles)
            ->filter(function($item) use ($article) {
                return $item['id'] !== $article['id'] && 
                       (str_contains($item['category'], explode('|', $article['category'])[0]) ||
                        similar_text(strtolower($item['title']), strtolower($article['title'])) > 5);
            })
            ->take(5)
            ->values()
            ->toArray();

        return view('article-detail', [
            'article' => $article,
            'relatedArticles' => $relatedArticles
        ]);
    }
}
