<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FlaskApiService
{
    protected $baseUrl =
        'http://127.0.0.1:5000';

    // =========================
    // NAIVE BAYES
    // =========================
    public function predictNB($text)
    {
        $response = Http::post(
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
        $response = Http::post(
            $this->baseUrl . '/predict/svm',
            [
                'content' => $text
            ]
        );

        return $response->json();
    }
}
