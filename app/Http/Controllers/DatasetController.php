<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatasetController extends Controller
{
    // =========================
    // UPLOAD DATASET
    // =========================
    public function upload(
        Request $request
    ) {

        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $file =
            $request->file('file');

        // =========================
        // FOLDER DATASET FLASK
        // =========================
        $destination =
            base_path(
                '../python-api/dataset'
            );

        // =========================
        // BUAT FOLDER
        // =========================
        if (!file_exists($destination)) {

            mkdir(
                $destination,
                0777,
                true
            );
        }

        // =========================
        // HAPUS DATASET LAMA
        // =========================
        $oldDataset =
            $destination .
            '/dataset.csv';

        if (file_exists($oldDataset)) {

            unlink($oldDataset);

        }

        // =========================
        // HAPUS MODEL LAMA
        // =========================
        $models = [

            base_path(
                '../python-api/models/nb_model.pkl'
            ),

            base_path(
                '../python-api/models/svm_model.pkl'
            )

        ];

        foreach ($models as $model) {

            if (file_exists($model)) {

                unlink($model);

            }
        }

        // =========================
        // SIMPAN DATASET BARU
        // =========================
        $file->move(
            $destination,
            'dataset.csv'
        );

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Dataset baru berhasil diupload. Silakan training ulang model.'
            );
    }
}
