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
        $response = Http::timeout(120)
            ->acceptJson()
            ->post(
                $this->baseUrl . '/predict/nb',
                [
                    'content' => $text
                ]
            );

        Log::info('FLASK NB RESPONSE', [
            'url' => $this->baseUrl . '/predict/nb',
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        $response->throw();

        return $response->json();
    }

    public function predictSVM($text)
    {
        $response = Http::timeout(120)
            ->acceptJson()
            ->post(
                $this->baseUrl . '/predict/svm',
                [
                    'content' => $text
                ]
            );

        Log::info('FLASK SVM RESPONSE', [
            'url' => $this->baseUrl . '/predict/svm',
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        $response->throw();

        return $response->json();
    }
}
