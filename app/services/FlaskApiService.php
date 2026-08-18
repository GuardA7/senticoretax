<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FlaskApiService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim(
            env('FLASK_API_URL'),
            '/'
        );
    }

    public function predictNB($text)
    {
        $url = $this->baseUrl . '/predict/nb';

        Log::info('CALLING FLASK NB', [
            'url' => $url,
            'content' => $text,
        ]);

        $response = Http::timeout(120)
            ->acceptJson()
            ->asJson()
            ->post($url, [
                'content' => $text
            ]);

        Log::info('FLASK NB RESPONSE', [
            'url' => $url,
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        $response->throw();

        return $response->json();
    }

    public function predictSVM($text)
    {
        $url = $this->baseUrl . '/predict/svm';

        Log::info('CALLING FLASK SVM', [
            'url' => $url,
            'content' => $text,
        ]);

        $response = Http::timeout(120)
            ->acceptJson()
            ->asJson()
            ->post($url, [
                'content' => $text
            ]);

        Log::info('FLASK SVM RESPONSE', [
            'url' => $url,
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        $response->throw();

        return $response->json();
    }
}
