<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\FlaskApiService;

class SentimentController extends Controller
{
    // =========================
    // NAIVE BAYES
    // =========================
    public function naiveBayes()
    {
        $accuracy = 0.8606;

        $results = [];

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
    public function svm()
    {
        $accuracy = 0.9012;

        $results = [];

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

        $request->validate([
            'userName' => 'required',
            'content' => 'required',
            'score' => 'required|numeric'
        ]);

        $userName =
            $request->userName;

        $content =
            $request->content;

        $score =
            $request->score;

        // =========================
        // PREDIKSI NB
        // =========================
        $nb =
            $flask->predictNB($content);

        // =========================
        // PREDIKSI SVM
        // =========================
        $svm =
            $flask->predictSVM($content);

        return view(
            'dashboard',
            [

                // dashboard
                'total' => 7546,
                'positif' => 5200,
                'negatif' => 1500,
                'netral' => 846,

                // akurasi
                'nbAccuracy' => 0.8606,
                'svmAccuracy' => 0.9012,

                // manual input
                'manualUser' =>
                    $userName,

                'manualText' =>
                    $content,

                'manualScore' =>
                    $score,

                // hasil model
                'nbResult' =>
                    $nb['result'],

                'svmResult' =>
                    $svm['result']

            ]
        );
    }
}
