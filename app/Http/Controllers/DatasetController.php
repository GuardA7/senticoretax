<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatasetController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx,xls,txt'
        ]);

        $file = $request->file('file');

        // =========================
        // FOLDER DATASET PYTHON
        // =========================
        $destination = base_path(
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
        $oldFiles = [

            $destination . '/dataset.csv',
            $destination . '/dataset.xlsx',
            $destination . '/dataset.xls'

        ];

        foreach ($oldFiles as $oldFile) {

            if (file_exists($oldFile)) {

                unlink($oldFile);

            }
        }

        // =========================
        // HAPUS HASIL PREPROCESSING
        // =========================
        $preprocessFile =
            $destination .
            '/preprocessing_result.csv';

        if (file_exists($preprocessFile)) {

            unlink($preprocessFile);

        }

        // =========================
        // EXTENSION FILE
        // =========================
        $extension =
            $file->getClientOriginalExtension();

        // =========================
        // SIMPAN FILE ASLI
        // =========================
        $file->move(
            $destination,
            'dataset.' . $extension
        );

        // =========================
        // AUTO PREPROCESSING
        // =========================
        pclose(
            popen(
                'start /B python ../python-api/preprocess_dataset.py',
                'r'
            )
        );

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Dataset berhasil diupload.'
            );
    }
}
