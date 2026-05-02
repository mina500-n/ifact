<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.ai.url', 'http://127.0.0.1:5000');
    }

    public function analyze(string $text): array
    {
        try {
            $response = Http::timeout(60)
                ->post("{$this->baseUrl}/analyze", [
                    'text' => $text,
                ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data'    => $response->json(),
                ];
            }

            Log::error('AI Service error', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);

            return [
                'success' => false,
                'error'   => 'AI service returned an error.',
            ];

        } catch (\Exception $e) {
            Log::error('AI Service exception', ['message' => $e->getMessage()]);

            return [
                'success' => false,
                'error'   => 'Could not reach AI service: ' . $e->getMessage(),
            ];
        }
    }

    public function ping(): bool
    {
        try {
            $response = Http::timeout(5)->get("{$this->baseUrl}/ping");
            return $response->successful();
        } catch (\Exception $e) {
            return false;
        }
    }
}
