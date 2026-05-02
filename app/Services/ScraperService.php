<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ScraperService
{
    public function fetchFromUrl(string $url): array
    {
        try {
            $response = Http::timeout(15)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/120 Safari/537.36',
                    'Accept'     => 'text/html,application/xhtml+xml',
                ])
                ->get($url);

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error'   => 'Could not reach the URL. Status: ' . $response->status(),
                ];
            }

            $html = $response->body();
            $text = $this->extractText($html);

            if (strlen($text) < 50) {
                return [
                    'success' => false,
                    'error'   => 'Could not extract enough text from this URL. Try pasting the content manually.',
                ];
            }

            return [
                'success' => true,
                'text'    => $text,
                'title'   => $this->extractTitle($html),
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'error'   => 'Scraping failed: ' . $e->getMessage(),
            ];
        }
    }

    private function extractText(string $html): string
    {
        // Remove scripts, styles, nav, footer, ads
        $html = preg_replace('/<script\b[^>]*>.*?<\/script>/is', '', $html);
        $html = preg_replace('/<style\b[^>]*>.*?<\/style>/is',  '', $html);
        $html = preg_replace('/<nav\b[^>]*>.*?<\/nav>/is',      '', $html);
        $html = preg_replace('/<footer\b[^>]*>.*?<\/footer>/is','', $html);
        $html = preg_replace('/<header\b[^>]*>.*?<\/header>/is','', $html);
        $html = preg_replace('/<aside\b[^>]*>.*?<\/aside>/is',  '', $html);

        // Try to extract article/main content first
        $article = '';
        if (preg_match('/<article\b[^>]*>(.*?)<\/article>/is', $html, $m)) {
            $article = $m[1];
        } elseif (preg_match('/<main\b[^>]*>(.*?)<\/main>/is', $html, $m)) {
            $article = $m[1];
        } elseif (preg_match('/<div[^>]*class="[^"]*(?:article|content|post|story|body)[^"]*"[^>]*>(.*?)<\/div>/is', $html, $m)) {
            $article = $m[1];
        }

        $source = $article ?: $html;

        // Strip remaining HTML tags
        $text = strip_tags($source);

        // Clean up whitespace
        $text = preg_replace('/\s+/', ' ', $text);
        $text = preg_replace('/\n{3,}/', "\n\n", $text);
        $text = trim($text);

        // Limit to 3000 characters for AI processing
        return Str::limit($text, 3000, '');
    }

    private function extractTitle(string $html): string
    {
        if (preg_match('/<title[^>]*>(.*?)<\/title>/is', $html, $m)) {
            return trim(strip_tags($m[1]));
        }
        if (preg_match('/<h1[^>]*>(.*?)<\/h1>/is', $html, $m)) {
            return trim(strip_tags($m[1]));
        }
        return '';
    }
}
