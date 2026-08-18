<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\IOFactory;

class EucsController extends Controller
{
    // =========================
    // HALAMAN EUCS
    // =========================
    public function index()
    {
        return view('eucs');
    }

    // =========================
    // UPLOAD KUESIONER
    // =========================
    public function upload(
        Request $request
    ) {

        $request->validate([

            'file' =>
                'required|file|mimes:xlsx,xls,csv'

        ]);

        // =========================
        // LOAD FILE
        // =========================
        $spreadsheet =
            IOFactory::load(
                $request
                    ->file('file')
                    ->getPathname()
            );

        $sheet =
            $spreadsheet->getActiveSheet();

        $rows =
            $sheet->toArray();

        // =========================
        // HAPUS HEADER
        // =========================
        array_shift($rows);

        // =========================
        // TOTAL RESPONDEN
        // =========================
        $total = count($rows);

        // =========================
        // DEFAULT
        // =========================
        $content = 0;

        $accuracy = 0;

        $format = 0;

        $ease = 0;

        $time = 0;

        // =========================
        // LOOP DATA
        // =========================
        foreach ($rows as $row) {

            // CONTENT
            $content += (

                ($row[1] ?? 0) +
                ($row[2] ?? 0) +
                ($row[3] ?? 0) +
                ($row[4] ?? 0) +
                ($row[5] ?? 0)

            );

            // ACCURACY
            $accuracy += (

                ($row[6] ?? 0) +
                ($row[7] ?? 0) +
                ($row[8] ?? 0) +
                ($row[9] ?? 0) +
                ($row[10] ?? 0)

            );

            // FORMAT
            $format += (

                ($row[11] ?? 0) +
                ($row[12] ?? 0) +
                ($row[13] ?? 0) +
                ($row[14] ?? 0) +
                ($row[15] ?? 0)

            );

            // EASE OF USE
            $ease += (

                ($row[16] ?? 0) +
                ($row[17] ?? 0) +
                ($row[18] ?? 0) +
                ($row[19] ?? 0) +
                ($row[20] ?? 0)

            );

            // TIMELINESS
            $time += (

                ($row[21] ?? 0) +
                ($row[22] ?? 0) +
                ($row[23] ?? 0) +
                ($row[24] ?? 0) +
                ($row[25] ?? 0)

            );
        }

        // =========================
        // RATA RATA SKOR (SKALA 1 - 5)
        // Setiap dimensi terdiri dari 5 item pernyataan,
        // masing-masing diisi dengan skala Likert 1 - 5.
        // Rata-rata dimensi = total skor / (jumlah responden x jumlah item)
        // =========================
        $contentAvg =
            round(
                $content / ($total * 5),
                2
            );

        $accuracyAvg =
            round(
                $accuracy / ($total * 5),
                2
            );

        $formatAvg =
            round(
                $format / ($total * 5),
                2
            );

        $easeAvg =
            round(
                $ease / ($total * 5),
                2
            );

        $timeAvg =
            round(
                $time / ($total * 5),
                2
            );

        // =========================
        // RATA RATA TOTAL
        // =========================
        $average = round(

            (
                $contentAvg +
                $accuracyAvg +
                $formatAvg +
                $easeAvg +
                $timeAvg
            ) / 5,

            2

        );

        return view(
            'eucs',
            [

                'content' =>
                    $contentAvg,

                'accuracy' =>
                    $accuracyAvg,

                'format' =>
                    $formatAvg,

                'ease' =>
                    $easeAvg,

                'time' =>
                    $timeAvg,

                'average' =>
                    $average

            ]
        );
    }
}
