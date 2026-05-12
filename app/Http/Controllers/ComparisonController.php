<?php

namespace App\Http\Controllers;

class ComparisonController extends Controller
{
    public function index()
    {
        // =========================
        // DATA PERBANDINGAN
        // =========================
        $comparison = [

            'nb' => [
                'accuracy' => 86.06,
                'precision' => 85.40,
                'recall' => 84.90,
                'f1' => 85.10
            ],

            'svm' => [
                'accuracy' => 90.12,
                'precision' => 89.80,
                'recall' => 89.50,
                'f1' => 89.60
            ]

        ];

        // =========================
        // MODEL TERBAIK
        // =========================
        $terbaik = 'SVM';

        $selisih = 4.06;

        return view(
            'perbandingan',
            compact(
                'comparison',
                'terbaik',
                'selisih'
            )
        );
    }
}
