<?php

namespace App\Http\Controllers;

class DataController extends Controller
{
    // =========================
    // CLEAR DATA
    // =========================
    public function clear()
    {
        $files = [

            // =========================
            // HASIL ANALISIS
            // =========================
            storage_path(
                'app/public/preprocessing.json'
            ),

            storage_path(
                'app/public/nb_results.json'
            ),

            storage_path(
                'app/public/svm_results.json'
            ),

            storage_path(
                'app/public/evaluation.json'
            ),

            storage_path(
                'app/public/comparison.json'
            ),

            // =========================
            // DATASET
            // =========================
            base_path(
                '../python-api/dataset/dataset.csv'
            ),

            // =========================
            // MODEL AI
            // =========================
            base_path(
                '../python-api/models/nb_model.pkl'
            ),

            base_path(
                '../python-api/models/svm_model.pkl'
            )

        ];

        foreach ($files as $file) {

            if (file_exists($file)) {

                unlink($file);

            }
        }

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Semua data dan model berhasil dihapus'
            );
    }
}
