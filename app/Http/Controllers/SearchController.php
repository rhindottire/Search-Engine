<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function query(Request $request)
    {
        $query = $request->input('query', 'kebudayaan nasional');

        // Path ke python dari virtual environment
        $pythonBin = base_path('.venv/Scripts/python.exe'); // <- ini path .venv di Windows
        $pythonScript = base_path('public/test_adalflow.py');

        // Escape argumen dengan aman
        $escapedQuery = escapeshellarg($query);
        $command = "\"{$pythonBin}\" \"{$pythonScript}\" {$escapedQuery}";

        // Jalankan command dan tangkap stderr juga
        $output = shell_exec($command . ' 2>&1');
        // dd($output);

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
}
