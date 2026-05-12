<?php

namespace App\Http\Controllers;

use App\Services\FlaskApiService;

class PreprocessingController extends Controller
{
    public function index(
        FlaskApiService $flask
    ) {

        // =========================
        // DATASET
        // =========================
        $path = base_path(
            '../python-api/dataset/dataset.csv'
        );

        $results = [];

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
            // HAPUS HEADER
            // =========================
            $header = array_shift($rows);

            // =========================
            // LOOP DATA
            // =========================
            foreach ($rows as $row) {

                $username =
                    $row[0] ?? '';

                $content =
                    $row[1] ?? '';

                $label =
                    $row[2] ?? '';

                // =========================
                // PREPROCESS FLASK
                // =========================
                $preprocess =
                    $flask->preprocessing(
                        $content
                    );

                $results[] = [

                    'username' =>
                        $username,

                    'content' =>
                        $content,

                    'label' =>
                        $label,

                    'casefolding' =>
                        $preprocess['casefolding'] ?? '',

                    'cleaning' =>
                        $preprocess['cleaning'] ?? '',

                    'tokenizing' =>
                        implode(
                            ', ',
                            $preprocess['tokenizing'] ?? []
                        ),

                    'stopword' =>
                        implode(
                            ', ',
                            $preprocess['stopword'] ?? []
                        ),

                    'stemming' =>
                        implode(
                            ', ',
                            $preprocess['stemming'] ?? []
                        ),

                    'final' =>
                        $preprocess['final'] ?? ''

                ];
            }
        }

        return view(
            'preprocessing',
            compact('results')
        );
    }
}
