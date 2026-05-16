@extends('layouts.app')

@section('title', 'Coretax Sentiment - Dashboard')

@section('content')

@if(session('success'))

<div class="mb-4 p-3 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm">

    {{ session('success') }}

</div>

@endif

<!-- HEADER -->
<div class="flex justify-between items-center mb-5">

    <div>

        <h2 class="text-2xl font-bold text-white">
            Dashboard Utama
        </h2>

        <p class="text-sm text-gray-400 mt-1">
            Ikhtisar analisis sentimen aplikasi Coretax
        </p>

        <div class="mt-3 inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-500/10 text-green-400 text-xs">

            <span class="w-2 h-2 rounded-full bg-green-400"></span>

            Flask API Connected

        </div>

    </div>

    <!-- EXPORT -->
    <a
        href="{{ route('export.laporan') }}"
        class="flex items-center gap-2 px-4 py-3 bg-blue-600 hover:bg-blue-700 rounded-xl font-semibold transition text-sm"
    >

        <span class="material-symbols-outlined text-base">
            download
        </span>

        Ekspor Laporan

    </a>

</div>

<!-- STATISTIK -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">

    <!-- TOTAL -->
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-5">

        <p class="text-sm text-gray-400 mb-3">
            Total Ulasan
        </p>

        <p class="text-4xl font-bold text-white">
            {{ number_format($total ?? 0) }}
        </p>

    </div>

    <!-- POSITIF -->
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-5">

        <p class="text-sm text-gray-400 mb-3">
            Positif
        </p>

        <p class="text-4xl font-bold text-green-400">
            {{ number_format($positif ?? 0) }}
        </p>

    </div>

    <!-- NETRAL -->
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-5">

        <p class="text-sm text-gray-400 mb-3">
            Netral
        </p>

        <p class="text-4xl font-bold text-yellow-400">
            {{ number_format($netral ?? 0) }}
        </p>

    </div>

    <!-- NEGATIF -->
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-5">

        <p class="text-sm text-gray-400 mb-3">
            Negatif
        </p>

        <p class="text-4xl font-bold text-red-400">
            {{ number_format($negatif ?? 0) }}
        </p>

    </div>

</div>

<!-- CHART -->
<div class="grid grid-cols-1 xl:grid-cols-2 gap-5 mb-6">

    <!-- AKURASI -->
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-5">

        <h3 class="text-xl font-bold mb-5">
            Perbandingan Akurasi Model
        </h3>

        <div class="space-y-6">

            <!-- NB -->
            <div>

                <div class="flex justify-between items-center mb-2">

                    <span class="text-base">
                        Naïve Bayes
                    </span>

                    <span class="text-base font-bold text-blue-400">

                        {{ number_format($nbAccuracy ?? 0, 2) }}%

                    </span>

                </div>

                <div class="w-full h-3 bg-gray-700 rounded-full overflow-hidden">

                    <div
                        class="h-full bg-blue-500 rounded-full transition-all duration-700"
                        style="width: {{ min($nbAccuracy, 100) }}%"
                    ></div>

                </div>

            </div>

            <!-- SVM -->
            <div>

                <div class="flex justify-between items-center mb-2">

                    <span class="text-base">
                        SVM
                    </span>

                    <span class="text-base font-bold text-indigo-400">

                        {{ number_format($svmAccuracy ?? 0, 2) }}%

                    </span>

                </div>

                <div class="w-full h-3 bg-gray-700 rounded-full overflow-hidden">

                    <div
                        class="h-full bg-indigo-500 rounded-full transition-all duration-700"
                        style="width: {{ min($svmAccuracy, 100) }}%"
                    ></div>

                </div>

            </div>

        </div>

        <!-- KESIMPULAN -->
        <div class="mt-6 p-4 rounded-xl bg-gray-900 border border-gray-700">

            <p class="text-sm text-gray-300 leading-relaxed">

                @if(($svmAccuracy ?? 0) > ($nbAccuracy ?? 0))

                    Model
                    <span class="text-indigo-400 font-bold">
                        SVM
                    </span>

                    memiliki performa lebih baik dibanding
                    Naïve Bayes.

                @elseif(($svmAccuracy ?? 0) < ($nbAccuracy ?? 0))

                    Model
                    <span class="text-blue-400 font-bold">
                        Naïve Bayes
                    </span>

                    memiliki performa lebih baik dibanding
                    SVM.

                @else

                    Kedua model memiliki performa yang sama.

                @endif

            </p>

        </div>

    </div>

    <!-- DISTRIBUSI -->
    <div class="bg-gray-800 border border-gray-700 rounded-xl p-5">

        <h3 class="text-xl font-bold mb-5">
            Distribusi Sentimen
        </h3>

        <div class="flex justify-center">

            <div class="w-[240px]">

                <canvas id="sentimentChart"></canvas>

            </div>

        </div>

        <!-- LEGEND -->
        <div class="flex justify-center gap-6 mt-5 flex-wrap">

            <div class="flex items-center gap-2">

                <div class="w-3 h-3 rounded-full bg-green-500"></div>

                <span class="text-sm">

                    Positif
                    ({{ number_format($positifPercent ?? 0, 1) }}%)

                </span>

            </div>

            <div class="flex items-center gap-2">

                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>

                <span class="text-sm">

                    Netral
                    ({{ number_format($netralPercent ?? 0, 1) }}%)

                </span>

            </div>

            <div class="flex items-center gap-2">

                <div class="w-3 h-3 rounded-full bg-red-500"></div>

                <span class="text-sm">

                    Negatif
                    ({{ number_format($negatifPercent ?? 0, 1) }}%)

                </span>

            </div>

        </div>

    </div>

</div>

<!-- HASIL MANUAL -->
@if(isset($manualText))

<div class="bg-gray-800 border border-gray-700 rounded-xl p-5 mb-6">

    <div class="flex items-center justify-between mb-5">

        <div>

            <h3 class="text-xl font-bold">
                Hasil Analisis Manual
            </h3>

            <p class="text-sm text-gray-400 mt-1">
                Prediksi realtime menggunakan AI
            </p>

        </div>

        <div class="px-3 py-1 rounded-full bg-green-500/10 text-green-400 text-xs font-semibold">

            LIVE ANALYSIS

        </div>

    </div>

    <!-- USER -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">

        <div class="bg-gray-900 rounded-xl p-4">

            <p class="text-sm text-gray-400 mb-2">
                Username
            </p>

            <p class="text-lg font-semibold">
                {{ $manualUser }}
            </p>

        </div>

        <div class="bg-gray-900 rounded-xl p-4">

            <p class="text-sm text-gray-400 mb-2">
                Status
            </p>

            <p class="text-lg font-semibold text-green-400">
                Berhasil Diproses
            </p>

        </div>

    </div>

    <!-- ULASAN -->
    <div class="bg-gray-900 rounded-xl p-4 mb-5">

        <p class="text-sm text-gray-400 mb-2">
            Ulasan Pengguna
        </p>

        <p class="text-sm leading-relaxed">
            {{ $manualText }}
        </p>

    </div>

    <!-- HASIL -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <!-- NB -->
        <div class="bg-blue-500/10 border border-blue-500/20 rounded-xl p-5">

            <h4 class="text-lg font-bold text-blue-400 mb-3">
                Naïve Bayes
            </h4>

            <p class="text-3xl font-bold mb-2">

                {{ ucfirst($nbResult) }}

            </p>

            <p class="text-sm text-gray-300">
                Prediksi menggunakan algoritma Naïve Bayes.
            </p>

        </div>

        <!-- SVM -->
        <div class="bg-indigo-500/10 border border-indigo-500/20 rounded-xl p-5">

            <h4 class="text-lg font-bold text-indigo-400 mb-3">
                SVM
            </h4>

            <p class="text-3xl font-bold mb-2">

                {{ ucfirst($svmResult) }}

            </p>

            <p class="text-sm text-gray-300">
                Prediksi menggunakan Support Vector Machine.
            </p>

        </div>

    </div>

</div>

@endif

<!-- FLOAT BUTTON -->
<button
    onclick="openManualModal()"
    class="fixed bottom-6 right-6 w-16 h-16 rounded-full bg-blue-600 hover:bg-blue-700 shadow-2xl flex items-center justify-center z-50 transition-all duration-300 hover:scale-110"
>

    <span class="material-symbols-outlined text-white text-3xl">
        edit
    </span>

</button>

<!-- MODAL -->
<div
    id="manualModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4"
>

    <div
        class="w-full max-w-xl bg-gray-800 border border-gray-700 rounded-2xl shadow-2xl overflow-hidden"
    >

        <!-- HEADER -->
        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-700">

            <div>

                <h3 class="text-2xl font-bold">
                    Input Ulasan Manual
                </h3>

                <p class="text-sm text-gray-400 mt-1">
                    Analisis sentimen otomatis menggunakan AI
                </p>

            </div>

            <button
                onclick="closeManualModal()"
                class="text-gray-400 hover:text-white transition"
            >

                <span class="material-symbols-outlined text-3xl">
                    close
                </span>

            </button>

        </div>

        <!-- FORM -->
        <form
            action="{{ route('manual.input') }}"
            method="POST"
            class="p-6"
        >

            @csrf

            <!-- USERNAME -->
            <div class="mb-5">

                <label class="block text-sm font-medium mb-2">

                    Username

                </label>

                <input
                    type="text"
                    name="userName"
                    placeholder="Masukkan username"
                    required
                    class="w-full px-4 py-3 rounded-xl bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >

            </div>

            <!-- ULASAN -->
            <div class="mb-6">

                <label class="block text-sm font-medium mb-2">

                    Ulasan

                </label>

                <textarea
                    name="content"
                    rows="6"
                    placeholder="Masukkan ulasan pengguna"
                    required
                    class="w-full px-4 py-3 rounded-xl bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                ></textarea>

            </div>

            <!-- BUTTON -->
            <button
                type="submit"
                class="w-full py-4 rounded-xl bg-blue-600 hover:bg-blue-700 transition text-white font-bold text-lg"
            >

                Analisis Sentimen

            </button>

        </form>

    </div>

</div>

<!-- CHART -->
<script>

new Chart(
    document.getElementById('sentimentChart'),
    {

        type: 'doughnut',

        data: {

            labels: [

                'Positif',
                'Negatif',
                'Netral'

            ],

            datasets: [{

                data: [

                    {{ $positif ?? 0 }},
                    {{ $negatif ?? 0 }},
                    {{ $netral ?? 0 }}

                ],

                backgroundColor: [

                    '#22c55e',
                    '#ef4444',
                    '#eab308'

                ],

                borderWidth: 0

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: true,

            plugins: {

                legend: {

                    display: false

                }

            }

        }

    }

);

function openManualModal()
{
    document
        .getElementById('manualModal')
        .classList
        .remove('hidden');

    document
        .getElementById('manualModal')
        .classList
        .add('flex');
}

function closeManualModal()
{
    document
        .getElementById('manualModal')
        .classList
        .remove('flex');

    document
        .getElementById('manualModal')
        .classList
        .add('hidden');
}

</script>

@endsection
