<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;

class DashboardController extends Controller
{
    public function index()
    {
        // =========================
        // DEFAULT
        // =========================
        $total = 0;

        $positif = 0;

        $negatif = 0;

        $netral = 0;

        // =========================
        // PATH DATASET
        // =========================
        $xlsx =
            'C:/senticoretax/python-api/dataset/dataset.xlsx';

        $xls =
            'C:/senticoretax/python-api/dataset/dataset.xls';

        $csv =
            'C:/senticoretax/python-api/dataset/dataset.csv';

        // =========================
        // LOAD XLSX
        // =========================
        if (file_exists($xlsx)) {

            $spreadsheet =
                IOFactory::load($xlsx);

            $sheet =
                $spreadsheet->getActiveSheet();

            $rows =
                $sheet->toArray();
        }

        // =========================
        // LOAD XLS
        // =========================
        elseif (file_exists($xls)) {

            $spreadsheet =
                IOFactory::load($xls);

            $sheet =
                $spreadsheet->getActiveSheet();

            $rows =
                $sheet->toArray();
        }

        // =========================
        // LOAD CSV
        // =========================
        elseif (file_exists($csv)) {

            $rows = array_map(
                'str_getcsv',
                file($csv)
            );
        }

        else {

            $rows = [];
        }

        // =========================
        // HAPUS HEADER
        // =========================
        if (!empty($rows)) {

            array_shift($rows);

            $total = count($rows);

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
        // DEFAULT AKURASI
        // =========================
        $nbAccuracy = 0;

        $svmAccuracy = 0;

        // =========================
        // FILE AKURASI
        // =========================
        $accuracyPath =
            'C:/senticoretax/python-api/models/accuracy.json';

        // =========================
        // CEK FILE
        // =========================
        if (file_exists($accuracyPath)) {

            $accuracy = json_decode(
                file_get_contents($accuracyPath),
                true
            );

            // =========================
            // NAIVE BAYES
            // =========================
            $nbAccuracy = floatval(

                $accuracy['naive_bayes']['accuracy']
                ?? 0

            );

            // =========================
            // SVM
            // =========================
            $svmAccuracy = floatval(

                $accuracy['svm']['accuracy']
                ?? 0

            );
        }

        // =========================
        // SESSION MANUAL
        // =========================
        $manualUser =
            session('manualUser');

        $manualText =
            session('manualText');

        $nbResult =
            session('nbResult');

        $svmResult =
            session('svmResult');

        // =========================
        // RETURN
        // =========================
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

                'svmAccuracy',

                'manualUser',

                'manualText',

                'nbResult',

                'svmResult'
            )
        );
    }
}
