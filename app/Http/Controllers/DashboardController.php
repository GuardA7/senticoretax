<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        // =========================
        // PATH DATASET
        // =========================
        $path = base_path(
            '../python-api/dataset/dataset.csv'
        );

        // =========================
        // DEFAULT
        // =========================
        $total = 0;

        $positif = 0;

        $negatif = 0;

        $netral = 0;

        // =========================
        // CEK FILE
        // =========================
        if (file_exists($path)) {

            // =========================
            // BACA CSV
            // =========================
            $rows = array_map(
                'str_getcsv',
                file($path)
            );

            // =========================
            // HEADER
            // =========================
            $header = array_shift($rows);

            // =========================
            // TOTAL
            // =========================
            $total = count($rows);

            // =========================
            // LOOP DATA
            // =========================
            foreach ($rows as $row) {

                $label =
                    strtolower(
                        trim($row[2] ?? '')
                    );

                if ($label == 'positif') {

                    $positif++;

                }

                elseif ($label == 'negatif') {

                    $negatif++;

                }

                elseif ($label == 'netral') {

                    $netral++;

                }
            }
        }

        // =========================
        // PERSENTASE
        // =========================
        $positifPercent =
            $total > 0
            ?
            ($positif / $total) * 100
            :
            0;

        $negatifPercent =
            $total > 0
            ?
            ($negatif / $total) * 100
            :
            0;

        $netralPercent =
            $total > 0
            ?
            ($netral / $total) * 100
            :
            0;

        // =========================
        // AKURASI MODEL
        // =========================
        $nbAccuracy = 0.88;

        $svmAccuracy = 0.92;

        return view(
            'dashboard',
            compact(

                'total',

                'positif',

                'negatif',

                'netral',

                'positifPercent',

                'negatifPercent',

                'netralPercent',

                'nbAccuracy',

                'svmAccuracy'

            )
        );
    }
}
