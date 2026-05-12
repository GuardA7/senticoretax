@extends('layouts.app')

@section('title', 'Coretax Sentiment - Dashboard')

@section('content')
@if(session('success'))

<div class="mb-5 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400">

    {{ session('success') }}

</div>

@endif
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold">Dashboard Utama</h2>
        <p class="text-gray-400 mt-1">Ikhtisar analisis sentimen aplikasi Coretax</p>
        <span class="inline-flex items-center gap-2 mt-2 px-3 py-1 rounded-full bg-green-500/10 text-green-400 text-xs">

    <span class="w-2 h-2 rounded-full bg-green-400"></span>

    Flask API Connected

</span>
    </div>
    <a href="{{ route('export.laporan') }}" class="flex items-center gap-2 px-4 py-2 bg-blue-600 rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">
        <span class="material-symbols-outlined text-sm">download</span>
        Ekspor Laporan
    </a>
</div>

<!-- Statistik -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <div class="bg-gray-800 rounded-xl p-5 border border-gray-700">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                <span class="material-symbols-outlined text-blue-400">forum</span>
            </div>
        </div>
        <p class="text-sm text-gray-400">Total Ulasan</p>
        <p class="text-3xl font-bold">{{ number_format($total) }}</p>
    </div>
    <div class="bg-gray-800 rounded-xl p-5 border border-gray-700">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                <span class="material-symbols-outlined text-green-400">sentiment_very_satisfied</span>
            </div>
            <span class="text-xs text-green-400">{{ $total > 0 ? round(($positif/$total)*100) : 0 }}%</span>
        </div>
        <p class="text-sm text-gray-400">Positif</p>
        <p class="text-3xl font-bold text-green-400">{{ number_format($positif) }}</p>
    </div>
    <div class="bg-gray-800 rounded-xl p-5 border border-gray-700">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 bg-yellow-500/20 rounded-lg flex items-center justify-center">
                <span class="material-symbols-outlined text-yellow-400">sentiment_neutral</span>
            </div>
            <span class="text-xs text-yellow-400">{{ $total > 0 ? round(($netral/$total)*100) : 0 }}%</span>
        </div>
        <p class="text-sm text-gray-400">Netral</p>
        <p class="text-3xl font-bold text-yellow-400">{{ number_format($netral) }}</p>
    </div>
    <div class="bg-gray-800 rounded-xl p-5 border border-gray-700">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 bg-red-500/20 rounded-lg flex items-center justify-center">
                <span class="material-symbols-outlined text-red-400">sentiment_very_dissatisfied</span>
            </div>
            <span class="text-xs text-red-400">{{ $total > 0 ? round(($negatif/$total)*100) : 0 }}%</span>
        </div>
        <p class="text-sm text-gray-400">Negatif</p>
        <p class="text-3xl font-bold text-red-400">{{ number_format($negatif) }}</p>
    </div>
</div>

<!-- Grafik -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
        <h3 class="text-lg font-semibold mb-4">Perbandingan Akurasi Model</h3>
        <div class="space-y-5">
            <div>
                <div class="flex justify-between mb-1">
                    <span class="text-sm">Naïve Bayes</span>
                    <span class="text-sm font-mono">{{ number_format($nbAccuracy * 100, 1) }}%</span>
                </div>
                <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
                    <div class="h-full bg-blue-500 rounded-full" style="width: {{ $nbAccuracy * 100 }}%"></div>
                </div>
            </div>
            <div>
                <div class="flex justify-between mb-1">
                    <span class="text-sm">SVM</span>
                    <span class="text-sm font-mono">{{ number_format($svmAccuracy * 100, 1) }}%</span>
                </div>
                <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
                    <div class="h-full bg-indigo-500 rounded-full" style="width: {{ $svmAccuracy * 100 }}%"></div>
                </div>
            </div>
        </div>
        <div class="mt-5 p-3 bg-gray-700/50 rounded-lg">
            <p class="text-xs text-gray-300">
                <span class="font-semibold">💡 Insight:</span>
                {{ $svmAccuracy >= $nbAccuracy ? 'SVM' : 'Naïve Bayes' }} lebih unggul dengan selisih {{ number_format(abs($svmAccuracy - $nbAccuracy) * 100, 1) }}%.
            </p>
        </div>
    </div>

    <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
        <h3 class="text-lg font-semibold mb-4">Distribusi Sentimen</h3>
        <canvas id="sentimentChart" class="w-48 h-48 mx-auto"></canvas>
        <div class="flex justify-center gap-6 mt-4">
            <div class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-green-500"></div><span class="text-sm">Positif {{ $total > 0 ? round(($positif/$total)*100) : 0 }}%</span></div>
            <div class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-yellow-500"></div><span class="text-sm">Netral {{ $total > 0 ? round(($netral/$total)*100) : 0 }}%</span></div>
            <div class="flex items-center gap-2"><div class="w-3 h-3 rounded-full bg-red-500"></div><span class="text-sm">Negatif {{ $total > 0 ? round(($negatif/$total)*100) : 0 }}%</span></div>
        </div>
    </div>
</div>
@if(isset($manualText))

<div class="mt-8 bg-gray-800 rounded-xl p-6 border border-gray-700">

    <div class="flex items-center justify-between mb-5">

        <div>
            <h3 class="text-lg font-semibold">
                Hasil Analisis Manual
            </h3>

            <p class="text-sm text-gray-400">
                Prediksi sentimen realtime menggunakan Flask AI
            </p>
        </div>

        <div class="px-3 py-1 rounded-full bg-green-500/10 text-green-400 text-xs font-semibold">
            LIVE
        </div>

    </div>

    <!-- DATA INPUT -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">

        <div class="bg-gray-900 rounded-xl p-4">

            <p class="text-xs text-gray-400 mb-1">
                Username
            </p>

            <p class="font-semibold">
                {{ $manualUser }}
            </p>

        </div>

        <div class="bg-gray-900 rounded-xl p-4">

            <p class="text-xs text-gray-400 mb-1">
                Score
            </p>

            <p class="font-semibold">
                {{ $manualScore }}
            </p>

        </div>

        <div class="bg-gray-900 rounded-xl p-4">

            <p class="text-xs text-gray-400 mb-1">
                Label Otomatis
            </p>

            <p class="font-semibold">

                @if($manualScore >= 4)

                    <span class="text-green-400">
                        Positif
                    </span>

                @elseif($manualScore == 3)

                    <span class="text-yellow-400">
                        Netral
                    </span>

                @else

                    <span class="text-red-400">
                        Negatif
                    </span>

                @endif

            </p>

        </div>

    </div>

    <!-- ULASAN -->
    <div class="mb-5">

        <p class="text-sm text-gray-400 mb-2">
            Ulasan
        </p>

        <div class="bg-gray-900 rounded-xl p-4">
            {{ $manualText }}
        </div>

    </div>

    <!-- HASIL MODEL -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <!-- NB -->
        <div class="bg-blue-500/10 border border-blue-500/20 rounded-xl p-5">

            <div class="flex items-center justify-between mb-3">

                <h4 class="font-semibold">
                    Naïve Bayes
                </h4>

                <span class="text-xs px-2 py-1 rounded-full bg-blue-500/20 text-blue-400">
                    TF-IDF
                </span>

            </div>

            <p class="text-3xl font-bold text-blue-400 mb-2">
                {{ ucfirst($nbResult['prediction']) }}
            </p>

            <p class="text-sm text-gray-300">
                Confidence:
                {{ $nbResult['confidence'] }}%
            </p>

        </div>

        <!-- SVM -->
        <div class="bg-indigo-500/10 border border-indigo-500/20 rounded-xl p-5">

            <div class="flex items-center justify-between mb-3">

                <h4 class="font-semibold">
                    SVM
                </h4>

                <span class="text-xs px-2 py-1 rounded-full bg-indigo-500/20 text-indigo-400">
                    LinearSVC
                </span>

            </div>

            <p class="text-3xl font-bold text-indigo-400 mb-2">
                {{ ucfirst($svmResult['prediction']) }}
            </p>

            <p class="text-sm text-gray-300">
                Support Vector Machine Prediction
            </p>

        </div>

    </div>

</div>

@endif
@if($total == 0 && !isset($manualText))
<div class="mt-8 p-8 bg-gray-800 rounded-xl border border-gray-700 text-center">
    <span class="material-symbols-outlined text-5xl text-gray-500">inbox</span>
    <p class="text-gray-400 mt-2">Belum ada data. Upload dataset atau input ulasan manual.</p>
</div>
@endif

<script>
    new Chart(document.getElementById('sentimentChart'), {
        type: 'doughnut',
        data: {
            labels: ['Positif', 'Negatif', 'Netral'],
            datasets: [{
                data: [{{ $positif }}, {{ $negatif }}, {{ $netral }}],
                backgroundColor: ['#22c55e', '#ef4444', '#eab308'],
                borderWidth: 0
            }]
        },
        options: { responsive: true, maintainAspectRatio: true, plugins: { legend: { display: false } } }
    });
</script>
@endsection
