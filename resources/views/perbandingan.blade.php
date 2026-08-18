@extends('layouts.app')

@section('title', 'Perbandingan Model')

@section('content')

<h2 class="text-3xl font-bold mb-6 text-slate-800">
    Perbandingan Performa Model
</h2>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

    <!-- ========================= -->
    <!-- NAIVE BAYES -->
    <!-- ========================= -->
    <div class="bg-white rounded-2xl border border-blue-100 p-6 premium-shadow">

        <div class="flex items-center gap-3 mb-5">

            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                <span class="material-symbols-outlined text-blue-700 text-xl">psychology</span>
            </div>

            <h3 class="text-xl font-bold text-blue-700">
                Naïve Bayes
            </h3>

        </div>

        <div class="grid grid-cols-2 gap-4">

            <div class="text-center p-4 bg-blue-50 rounded-xl">

                <p class="text-sm text-slate-500">
                    Accuracy
                </p>

                <p class="text-2xl font-bold text-slate-800">
                    {{ number_format($naiveBayes['accuracy'], 2) }}%
                </p>

            </div>

            <div class="text-center p-4 bg-cyan-50 rounded-xl">

                <p class="text-sm text-slate-500">
                    Precision
                </p>

                <p class="text-2xl font-bold text-cyan-700">
                    {{ number_format($naiveBayes['precision'], 2) }}%
                </p>

            </div>

            <div class="text-center p-4 bg-amber-50 rounded-xl">

                <p class="text-sm text-slate-500">
                    Recall
                </p>

                <p class="text-2xl font-bold text-amber-600">
                    {{ number_format($naiveBayes['recall'], 2) }}%
                </p>

            </div>

            <div class="text-center p-4 bg-pink-50 rounded-xl">

                <p class="text-sm text-slate-500">
                    F1-Score
                </p>

                <p class="text-2xl font-bold text-pink-600">
                    {{ number_format($naiveBayes['f1_score'], 2) }}%
                </p>

            </div>

        </div>

    </div>

    <!-- ========================= -->
    <!-- SVM -->
    <!-- ========================= -->
    <div class="bg-white rounded-2xl border border-blue-100 p-6 premium-shadow">

        <div class="flex items-center gap-3 mb-5">

            <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center">
                <span class="material-symbols-outlined text-amber-600 text-xl">insights</span>
            </div>

            <h3 class="text-xl font-bold text-amber-600">
                SVM
            </h3>

        </div>

        <div class="grid grid-cols-2 gap-4">

            <div class="text-center p-4 bg-blue-50 rounded-xl">

                <p class="text-sm text-slate-500">
                    Accuracy
                </p>

                <p class="text-2xl font-bold text-slate-800">
                    {{ number_format($svm['accuracy'], 2) }}%
                </p>

            </div>

            <div class="text-center p-4 bg-cyan-50 rounded-xl">

                <p class="text-sm text-slate-500">
                    Precision
                </p>

                <p class="text-2xl font-bold text-cyan-700">
                    {{ number_format($svm['precision'], 2) }}%
                </p>

            </div>

            <div class="text-center p-4 bg-amber-50 rounded-xl">

                <p class="text-sm text-slate-500">
                    Recall
                </p>

                <p class="text-2xl font-bold text-amber-600">
                    {{ number_format($svm['recall'], 2) }}%
                </p>

            </div>

            <div class="text-center p-4 bg-pink-50 rounded-xl">

                <p class="text-sm text-slate-500">
                    F1-Score
                </p>

                <p class="text-2xl font-bold text-pink-600">
                    {{ number_format($svm['f1_score'], 2) }}%
                </p>

            </div>

        </div>

    </div>

</div>

<!-- ========================= -->
<!-- CHART -->
<!-- ========================= -->
<div class="bg-white rounded-2xl border border-blue-100 p-6 premium-shadow">

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

    <div class="mt-6 p-5 bg-gradient-to-r from-blue-50 to-amber-50 rounded-xl border border-blue-100">

        <p class="text-sm text-slate-700">

            <span class="font-semibold">
                📊 Kesimpulan:
            </span>

            Model

            <strong class="text-lg text-slate-800">
                {{ $terbaik }}
            </strong>

            memiliki performa terbaik
            dengan selisih akurasi

            <strong class="text-slate-800">
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
                        'rgba(37,99,235,0.15)',

                    borderColor:
                        '#1e3a5f',

                    pointBackgroundColor:
                        '#1e3a5f',

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
                        'rgba(245,196,81,0.25)',

                    borderColor:
                        '#d97706',

                    pointBackgroundColor:
                        '#d97706',

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

                    angleLines: {

                        color: '#e2e8f0'

                    },

                    grid: {

                        color: '#e2e8f0'

                    },

                    pointLabels: {

                        color: '#475569'

                    },

                    ticks: {

                        stepSize: 20,

                        color: '#94a3b8',

                        backdropColor: 'transparent'

                    }

                }

            },

            plugins: {

                legend: {

                    labels: {

                        color: '#475569'

                    }

                }

            }

        }

    }

);

</script>

@endsection
