<?php

namespace App\Http\Controllers;

class EucsController extends Controller
{
    public function index()
    {
        // =========================
        // DATA EUCS
        // =========================
        $kepuasan = 78.5;

        $positif = 5200;

        $total = 7546;

        // =========================
        // METRIK EUCS
        // =========================
        $eucsMetrics = [

            'Content' => [
                'puas' => 80,
                'tidak_puas' => 20
            ],

            'Accuracy' => [
                'puas' => 78,
                'tidak_puas' => 22
            ],

            'Format' => [
                'puas' => 75,
                'tidak_puas' => 25
            ],

            'Ease of Use' => [
                'puas' => 82,
                'tidak_puas' => 18
            ],

            'Timeliness' => [
                'puas' => 77,
                'tidak_puas' => 23
            ]

        ];

        return view(
            'eucs',
            compact(
                'kepuasan',
                'positif',
                'total',
                'eucsMetrics'
            )
        );
    }
}
