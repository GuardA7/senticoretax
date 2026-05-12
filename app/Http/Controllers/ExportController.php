<?php

namespace App\Http\Controllers;

class ExportController extends Controller
{
    // =========================
    // EXPORT CSV
    // =========================
    public function laporan()
    {
        $fileName =
            'laporan-sentimen.csv';

        $headers = [

            'Content-Type' =>
                'text/csv',

            'Content-Disposition' =>
                'attachment; filename="'.$fileName.'"',

        ];

        $callback = function () {

            $file =
                fopen(
                    'php://output',
                    'w'
                );

            // =========================
            // HEADER
            // =========================
            fputcsv($file, [

                'Model',
                'Accuracy'

            ]);

            // =========================
            // DATA
            // =========================
            fputcsv($file, [

                'Naive Bayes',
                '88.12%'

            ]);

            fputcsv($file, [

                'SVM',
                '92.45%'

            ]);

            fclose($file);
        };

        return response()->stream(
            $callback,
            200,
            $headers
        );
    }
}
