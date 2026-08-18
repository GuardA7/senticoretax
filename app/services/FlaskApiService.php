<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FlaskApiService
{
    protected $baseUrl =
        'https://web-production-eda61.up.railway.app';

    // =========================
    // NAIVE BAYES
    // =========================
    public function predictNB($text)
    {
        $response = Https::withoutVerifying()
    ->post(
        $this->baseUrl . '/predict/nb',
        [
            'content' => $text
        ]
    );

        return $response->json();
    }

    // =========================
    // SVM
    // =========================
    public function predictSVM($text)
    {
       $response = Https::withoutVerifying()
    ->post(
        $this->baseUrl . '/predict/svm',
        [
            'content' => $text
        ]
    );

        return $response->json();
    }
}
