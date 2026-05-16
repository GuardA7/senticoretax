<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\FlaskApiService;

use PhpOffice\PhpSpreadsheet\IOFactory;

class SentimentController extends Controller
{
    // =========================
    // NAIVE BAYES
    // =========================
    public function naiveBayes(
        FlaskApiService $flask
    ) {

        $accuracy = 0;

        $results = [];

        // =========================
        // FILE AKURASI
        // =========================
        $accuracyPath =
            'C:/senticoretax/python-api/models/accuracy.json';

        // =========================
        // CEK FILE
        // =========================
        if (file_exists($accuracyPath)) {

            $data = json_decode(
                file_get_contents($accuracyPath),
                true
            );

            $accuracy = floatval(

                $data['naive_bayes']['accuracy']
                ?? 0

            );
        }

        // =========================
        // DATASET
        // =========================
        $dataset =
            'C:/senticoretax/python-api/dataset/dataset.xlsx';

        // =========================
        // CEK DATASET
        // =========================
        if (file_exists($dataset)) {

            $spreadsheet =
                IOFactory::load($dataset);

            $sheet =
                $spreadsheet->getActiveSheet();

            $rows =
                $sheet->toArray();

            // =========================
            // HAPUS HEADER
            // =========================
            array_shift($rows);

            // =========================
            // LOOP DATA
            // =========================
            foreach (
                array_slice($rows, 0, 100)
                as $row
            ) {

                $content =
                    $row[1] ?? '';

                // =========================
                // PREDIKSI NB
                // =========================
                $prediction =
                    $flask->predictNB(
                        $content
                    );

                $results[] = [

                    'content' =>
                        $content,

                    'result' =>
                        $prediction['result']

                ];
            }
        }

        return view(
            'klasifikasi_nb',
            compact(
                'accuracy',
                'results'
            )
        );
    }

    // =========================
    // SVM
    // =========================
    public function svm(
        FlaskApiService $flask
    ) {

        $accuracy = 0;

        $results = [];

        // =========================
        // FILE AKURASI
        // =========================
        $accuracyPath =
            'C:/senticoretax/python-api/models/accuracy.json';

        // =========================
        // CEK FILE
        // =========================
        if (file_exists($accuracyPath)) {

            $data = json_decode(
                file_get_contents($accuracyPath),
                true
            );

            $accuracy = floatval(

                $data['svm']['accuracy']
                ?? 0

            );
        }

        // =========================
        // DATASET
        // =========================
        $dataset =
            'C:/senticoretax/python-api/dataset/dataset.xlsx';

        // =========================
        // CEK DATASET
        // =========================
        if (file_exists($dataset)) {

            $spreadsheet =
                IOFactory::load($dataset);

            $sheet =
                $spreadsheet->getActiveSheet();

            $rows =
                $sheet->toArray();

            // =========================
            // HAPUS HEADER
            // =========================
            array_shift($rows);

            // =========================
            // LOOP DATA
            // =========================
            foreach (
                array_slice($rows, 0, 100)
                as $row
            ) {

                $content =
                    $row[1] ?? '';

                // =========================
                // PREDIKSI SVM
                // =========================
                $prediction =
                    $flask->predictSVM(
                        $content
                    );

                $results[] = [

                    'content' =>
                        $content,

                    'result' =>
                        $prediction['result']

                ];
            }
        }

        return view(
            'klasifikasi_svm',
            compact(
                'accuracy',
                'results'
            )
        );
    }

    // =========================
    // INPUT MANUAL
    // =========================
    public function manualInput(
        Request $request,
        FlaskApiService $flask
    ) {

        // =========================
        // VALIDASI
        // =========================
        $request->validate([

            'userName' =>
                'required',

            'content' =>
                'required'

        ]);

        // =========================
        // INPUT USER
        // =========================
        $userName =
            $request->userName;

        $content =
            $request->content;

        // =========================
        // PREDIKSI NAIVE BAYES
        // =========================
        $nb =
            $flask->predictNB(
                $content
            );

        // =========================
        // PREDIKSI SVM
        // =========================
        $svm =
            $flask->predictSVM(
                $content
            );

        // =========================
        // SIMPAN SESSION
        // =========================
        session([

            'manualUser' =>
                $userName,

            'manualText' =>
                $content,

            'nbResult' =>
                $nb['result'],

            'svmResult' =>
                $svm['result']

        ]);

        // =========================
        // REDIRECT DASHBOARD
        // =========================
        return redirect()
            ->route('dashboard');
    }
}
