<?php

namespace App\Http\Controllers;

class EvaluationController extends Controller
{
    public function index()
    {
        // =========================
        // DEFAULT
        // =========================
        $nbMetrics = [];

        $svmMetrics = [];

        // =========================
        // FILE AKURASI
        // =========================
        $path = $this->pythonApiPath('models/accuracy.json');

        // =========================
        // CEK FILE
        // =========================
        if (file_exists($path)) {

            $data = json_decode(
                file_get_contents($path),
                true
            );

            $data = is_array($data) ? $data : [];

            // =========================
            // NAIVE BAYES
            // =========================
            $nbMetrics = [
                'accuracy' => data_get($data, 'naive_bayes.accuracy', 0),
                'precision' => data_get($data, 'naive_bayes.precision', 0),
                'recall' => data_get($data, 'naive_bayes.recall', 0),
                'f1_score' => data_get($data, 'naive_bayes.f1_score', 0),
            ];

            // =========================
            // SVM
            // =========================
            $svmMetrics = [
                'accuracy' => data_get($data, 'svm.accuracy', 0),
                'precision' => data_get($data, 'svm.precision', 0),
                'recall' => data_get($data, 'svm.recall', 0),
                'f1_score' => data_get($data, 'svm.f1_score', 0),
            ];
        }

        // =========================
        // CONFUSION MATRIX DUMMY
        // =========================
        $nbConfusion = [

            'positif' => [
                'positif' => 500,
                'negatif' => 20,
                'netral' => 10
            ],

            'negatif' => [
                'positif' => 15,
                'negatif' => 300,
                'netral' => 12
            ],

            'netral' => [
                'positif' => 11,
                'negatif' => 18,
                'netral' => 150
            ]

        ];

        $svmConfusion = [

            'positif' => [
                'positif' => 520,
                'negatif' => 10,
                'netral' => 5
            ],

            'negatif' => [
                'positif' => 10,
                'negatif' => 320,
                'netral' => 7
            ],

            'netral' => [
                'positif' => 7,
                'negatif' => 12,
                'netral' => 160
            ]

        ];

        return view(
            'evaluasi',
            compact(
                'nbMetrics',
                'svmMetrics',
                'nbConfusion',
                'svmConfusion'
            )
        );
    }
}
