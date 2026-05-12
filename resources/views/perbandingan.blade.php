@extends('layouts.app')

@section('title', 'Perbandingan Model')

@section('content')
<h2 class="text-2xl font-bold mb-6">Perbandingan Performa Model</h2>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
        <h3 class="text-lg font-semibold text-blue-400 mb-4">Naïve Bayes</h3>
        <div class="grid grid-cols-2 gap-3">
            <div class="text-center p-3 bg-gray-700/50 rounded-lg">
                <p class="text-xs text-gray-400">Akurasi</p>
                <p class="text-xl font-bold">{{ number_format($comparison['nb']['accuracy'], 1) }}%</p>
            </div>
            <div class="text-center p-3 bg-gray-700/50 rounded-lg">
                <p class="text-xs text-gray-400">Precision</p>
                <p class="text-xl font-bold">{{ number_format($comparison['nb']['precision'], 1) }}%</p>
            </div>
            <div class="text-center p-3 bg-gray-700/50 rounded-lg">
                <p class="text-xs text-gray-400">Recall</p>
                <p class="text-xl font-bold">{{ number_format($comparison['nb']['recall'], 1) }}%</p>
            </div>
            <div class="text-center p-3 bg-gray-700/50 rounded-lg">
                <p class="text-xs text-gray-400">F1-Score</p>
                <p class="text-xl font-bold">{{ number_format($comparison['nb']['f1'], 1) }}%</p>
            </div>
        </div>
    </div>

    <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
        <h3 class="text-lg font-semibold text-indigo-400 mb-4">SVM</h3>
        <div class="grid grid-cols-2 gap-3">
            <div class="text-center p-3 bg-gray-700/50 rounded-lg">
                <p class="text-xs text-gray-400">Akurasi</p>
                <p class="text-xl font-bold">{{ number_format($comparison['svm']['accuracy'], 1) }}%</p>
            </div>
            <div class="text-center p-3 bg-gray-700/50 rounded-lg">
                <p class="text-xs text-gray-400">Precision</p>
                <p class="text-xl font-bold">{{ number_format($comparison['svm']['precision'], 1) }}%</p>
            </div>
            <div class="text-center p-3 bg-gray-700/50 rounded-lg">
                <p class="text-xs text-gray-400">Recall</p>
                <p class="text-xl font-bold">{{ number_format($comparison['svm']['recall'], 1) }}%</p>
            </div>
            <div class="text-center p-3 bg-gray-700/50 rounded-lg">
                <p class="text-xs text-gray-400">F1-Score</p>
                <p class="text-xl font-bold">{{ number_format($comparison['svm']['f1'], 1) }}%</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
    <canvas id="comparisonChart" height="300"></canvas>

    <div class="mt-5 p-4 bg-blue-900/30 rounded-lg border border-blue-800">
        <p class="text-sm">
            <span class="font-semibold">📊 Kesimpulan:</span>
            Model <strong class="text-lg">{{ $terbaik }}</strong> memiliki performa terbaik
            dengan selisih akurasi <strong>{{ number_format($selisih, 1) }}%</strong>.
        </p>
    </div>
</div>

<script>
    new Chart(document.getElementById('comparisonChart'), {
        type: 'radar',
        data: {
            labels: ['Akurasi', 'Precision', 'Recall', 'F1-Score'],
            datasets: [
                {
                    label: 'Naïve Bayes',
                    data: [{{ $comparison['nb']['accuracy'] }}, {{ $comparison['nb']['precision'] }}, {{ $comparison['nb']['recall'] }}, {{ $comparison['nb']['f1'] }}],
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderColor: '#3b82f6',
                    borderWidth: 2
                },
                {
                    label: 'SVM',
                    data: [{{ $comparison['svm']['accuracy'] }}, {{ $comparison['svm']['precision'] }}, {{ $comparison['svm']['recall'] }}, {{ $comparison['svm']['f1'] }}],
                    backgroundColor: 'rgba(99, 102, 241, 0.2)',
                    borderColor: '#6366f1',
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: { r: { beginAtZero: true, max: 100, ticks: { stepSize: 20 } } }
        }
    });
</script>
@endsection
