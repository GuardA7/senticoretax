<?php

namespace App\Http\Controllers;

class EvaluationController extends Controller
{
    public function index()
    {
        // =========================
        // METRIK NB
        // =========================
        $nbMetrics = [
            'accuracy' => 0.8606,

            'by_class' => [

                'positif' => [
                    'precision' => 0.89,
                    'recall' => 0.91,
                    'f1' => 0.90
                ],

                'negatif' => [
                    'precision' => 0.84,
                    'recall' => 0.81,
                    'f1' => 0.82
                ],

                'netral' => [
                    'precision' => 0.78,
                    'recall' => 0.75,
                    'f1' => 0.76
                ]

            ]
        ];

        // =========================
        // METRIK SVM
        // =========================
        $svmMetrics = [
            'accuracy' => 0.9012,

            'by_class' => [

                'positif' => [
                    'precision' => 0.93,
                    'recall' => 0.92,
                    'f1' => 0.92
                ],

                'negatif' => [
                    'precision' => 0.88,
                    'recall' => 0.86,
                    'f1' => 0.87
                ],

                'netral' => [
                    'precision' => 0.82,
                    'recall' => 0.80,
                    'f1' => 0.81
                ]

            ]
        ];

        // =========================
        // CONFUSION MATRIX NB
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

        // =========================
        // CONFUSION MATRIX SVM
        // =========================
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
