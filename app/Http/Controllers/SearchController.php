<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller {
    public function query(Request $request) {
        $query = $request->query("query");

        $data = cache()->remember("search_{$query}", 60, function () use ($query) {
            $escapedQuery = escapeshellarg($query); // prevent shell injection
            $output = shell_exec("python query.py indexDB 10 {$escapedQuery}");
            // dump($output);
            $list_data = array_filter(explode("\n", $output));
            return array_map(function ($data) {
                return json_decode(trim($data), true);
            }, $list_data);
        });

        return view("search", [
            "query" => $query,
            "data" => $data
        ]);
    }
}
