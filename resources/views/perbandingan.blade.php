@extends('layouts.app')

@section('title', 'Perbandingan Model')

@section('content')

<h2 class="text-3xl font-bold mb-6">
    Perbandingan Performa Model
</h2>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

    <!-- ========================= -->
    <!-- NAIVE BAYES -->
    <!-- ========================= -->
    <div class="bg-gray-800 rounded-2xl border border-gray-700 p-6">

        <h3 class="text-xl font-bold text-blue-400 mb-5">
            Naïve Bayes
        </h3>

        <div class="grid grid-cols-2 gap-4">

            <div class="text-center p-4 bg-gray-700/40 rounded-xl">

                <p class="text-sm text-gray-400">
                    Accuracy
                </p>

                <p class="text-2xl font-bold">
                    {{ number_format($naiveBayes['accuracy'], 2) }}%
                </p>

            </div>

            <div class="text-center p-4 bg-gray-700/40 rounded-xl">

                <p class="text-sm text-gray-400">
                    Precision
                </p>

                <p class="text-2xl font-bold text-cyan-400">
                    {{ number_format($naiveBayes['precision'], 2) }}%
                </p>

            </div>

            <div class="text-center p-4 bg-gray-700/40 rounded-xl">

                <p class="text-sm text-gray-400">
                    Recall
                </p>

                <p class="text-2xl font-bold text-yellow-400">
                    {{ number_format($naiveBayes['recall'], 2) }}%
                </p>

            </div>

            <div class="text-center p-4 bg-gray-700/40 rounded-xl">

                <p class="text-sm text-gray-400">
                    F1-Score
                </p>

                <p class="text-2xl font-bold text-pink-400">
                    {{ number_format($naiveBayes['f1_score'], 2) }}%
                </p>

            </div>

        </div>

    </div>

    <!-- ========================= -->
    <!-- SVM -->
    <!-- ========================= -->
    <div class="bg-gray-800 rounded-2xl border border-gray-700 p-6">

        <h3 class="text-xl font-bold text-indigo-400 mb-5">
            SVM
        </h3>

        <div class="grid grid-cols-2 gap-4">

            <div class="text-center p-4 bg-gray-700/40 rounded-xl">

                <p class="text-sm text-gray-400">
                    Accuracy
                </p>

                <p class="text-2xl font-bold">
                    {{ number_format($svm['accuracy'], 2) }}%
                </p>

            </div>

            <div class="text-center p-4 bg-gray-700/40 rounded-xl">

                <p class="text-sm text-gray-400">
                    Precision
                </p>

                <p class="text-2xl font-bold text-cyan-400">
                    {{ number_format($svm['precision'], 2) }}%
                </p>

            </div>

            <div class="text-center p-4 bg-gray-700/40 rounded-xl">

                <p class="text-sm text-gray-400">
                    Recall
                </p>

                <p class="text-2xl font-bold text-yellow-400">
                    {{ number_format($svm['recall'], 2) }}%
                </p>

            </div>

            <div class="text-center p-4 bg-gray-700/40 rounded-xl">

                <p class="text-sm text-gray-400">
                    F1-Score
                </p>

                <p class="text-2xl font-bold text-pink-400">
                    {{ number_format($svm['f1_score'], 2) }}%
                </p>

            </div>

        </div>

    </div>

</div>

<!-- ========================= -->
<!-- CHART -->
<!-- ========================= -->
<div class="bg-gray-800 rounded-2xl border border-gray-700 p-6">

    <canvas id="comparisonChart" height="120"></canvas>

    @php

        $terbaik =
            $svm['accuracy'] >
            $naiveBayes['accuracy']
            ? 'SVM'
            : 'Naïve Bayes';

        $selisih =
            abs(
                $svm['accuracy']
                -
                $naiveBayes['accuracy']
            );

    @endphp

    <div class="mt-6 p-5 bg-blue-900/20 rounded-xl border border-blue-800">

        <p class="text-sm">

            <span class="font-semibold">
                📊 Kesimpulan:
            </span>

            Model

            <strong class="text-lg">
                {{ $terbaik }}
            </strong>

            memiliki performa terbaik
            dengan selisih akurasi

            <strong>
                {{ number_format($selisih, 2) }}%
            </strong>

        </p>

    </div>

</div>

<script>

new Chart(
    document.getElementById(
        'comparisonChart'
    ),
    {

        type: 'radar',

        data: {

            labels: [

                'Accuracy',

                'Precision',

                'Recall',

                'F1-Score'

            ],

            datasets: [

                {

                    label: 'Naïve Bayes',

                    data: [

                        {{ $naiveBayes['accuracy'] }},

                        {{ $naiveBayes['precision'] }},

                        {{ $naiveBayes['recall'] }},

                        {{ $naiveBayes['f1_score'] }}

                    ],

                    backgroundColor:
                        'rgba(59,130,246,0.2)',

                    borderColor:
                        '#3b82f6',

                    borderWidth: 2

                },

                {

                    label: 'SVM',

                    data: [

                        {{ $svm['accuracy'] }},

                        {{ $svm['precision'] }},

                        {{ $svm['recall'] }},

                        {{ $svm['f1_score'] }}

                    ],

                    backgroundColor:
                        'rgba(99,102,241,0.2)',

                    borderColor:
                        '#6366f1',

                    borderWidth: 2

                }

            ]
        },

        options: {

            responsive: true,

            maintainAspectRatio: true,

            scales: {

                r: {

                    beginAtZero: true,

                    max: 100,

                    ticks: {

                        stepSize: 20

                    }

                }

            }

        }

    }

);

</script>

@endsection
