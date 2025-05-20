<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class FonteServices {
    protected $apiKey;
    protected $baseUrl;

    public function __construct() {
        $this->apiKey = env('FONNTE_API_KEY');
        $this->baseUrl = env('FONNTE_API_URL');
    }

    public function sendWhatsapp($phone, $message)
{
    try {
        $response = Http::withHeaders([
            'Authorization' => config('services.fonnte.api_key')
        ])->post(config('services.fonnte.api_url') . 'send', [
            'target' => $phone,
            'message' => $message
        ]);

        // Log response lengkap
        Log::info('Fonnte Response', [
            'status' => $response->status(),
            'body' => $response->body()
        ]);

        return $response->json();

    } catch (\Exception $e) {
        Log::error('Fonnte Error: ' . $e->getMessage());
        return [
            'status' => false,
            'message' => $e->getMessage()
        ];
    }
}
}
