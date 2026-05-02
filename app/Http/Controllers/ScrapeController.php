<?php

namespace App\Http\Controllers;

use App\Services\ScraperService;
use Illuminate\Http\Request;

class ScrapeController extends Controller
{
    protected ScraperService $scraper;

    public function __construct(ScraperService $scraper)
    {
        $this->scraper = $scraper;
    }

    public function fetch(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $result = $this->scraper->fetchFromUrl($request->url);

        if (!$result['success']) {
            return response()->json([
                'success' => false,
                'error'   => $result['error'],
            ], 422);
        }

        return response()->json([
            'success' => true,
            'text'    => $result['text'],
            'title'   => $result['title'] ?? '',
        ]);
    }
}
