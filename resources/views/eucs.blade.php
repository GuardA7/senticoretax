@extends('layouts.app')

@section('title', 'Analisis Kepuasan')

@section('content')

<h2 class="text-3xl font-bold mb-2">
    Analisis Kepuasan
</h2>

<p class="text-gray-400 mb-6">
    Evaluasi kepuasan pengguna aplikasi Coretax
    berdasarkan metode End User Computing Satisfaction.
</p>

{{-- =========================
UPLOAD
========================= --}}
<div class="bg-gray-800 border border-gray-700 rounded-2xl p-5 mb-6">

    <form method="POST"
          action="{{ route('upload.eucs') }}"
          enctype="multipart/form-data"
          class="flex flex-col md:flex-row gap-4 items-center">

        @csrf

        <input type="file"
               name="file"
               required
               class="text-sm text-gray-300">

        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 transition px-5 py-2 rounded-xl font-semibold">

            Upload Kuesioner

        </button>

    </form>

</div>

@if(isset($average))

@php

    function kategori($nilai)
    {
        if ($nilai >= 81) {
            return 'Sangat Puas';
        }
        elseif ($nilai >= 61) {
            return 'Puas';
        }
        elseif ($nilai >= 41) {
            return 'Cukup';
        }
        elseif ($nilai >= 21) {
            return 'Tidak Puas';
        }

        return 'Sangat Tidak Puas';
    }

    function warna($nilai)
    {
        if ($nilai >= 81) {
            return 'bg-green-500';
        }
        elseif ($nilai >= 61) {
            return 'bg-blue-500';
        }
        elseif ($nilai >= 41) {
            return 'bg-yellow-500';
        }

        return 'bg-red-500';
    }

@endphp

{{-- =========================
CARD EUCS
========================= --}}
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-5 mb-8">

    {{-- CONTENT --}}
    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-5">

        <p class="text-gray-400 text-sm mb-2">
            Content
        </p>

        <h3 class="text-4xl font-bold mb-2">
            {{ $content }}%
        </h3>

        <p class="text-sm text-gray-300 mb-3">
            Kelengkapan informasi aplikasi
        </p>

        <div class="w-full bg-gray-700 rounded-full h-2 mb-2">

            <div class="{{ warna($content) }} h-2 rounded-full"
                 style="width: {{ $content }}%">

            </div>

        </div>

        <span class="text-sm font-semibold">
            {{ kategori($content) }}
        </span>

    </div>

    {{-- ACCURACY --}}
    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-5">

        <p class="text-gray-400 text-sm mb-2">
            Accuracy
        </p>

        <h3 class="text-4xl font-bold mb-2">
            {{ $accuracy }}%
        </h3>

        <p class="text-sm text-gray-300 mb-3">
            Keakuratan informasi aplikasi
        </p>

        <div class="w-full bg-gray-700 rounded-full h-2 mb-2">

            <div class="{{ warna($accuracy) }} h-2 rounded-full"
                 style="width: {{ $accuracy }}%">

            </div>

        </div>

        <span class="text-sm font-semibold">
            {{ kategori($accuracy) }}
        </span>

    </div>

    {{-- FORMAT --}}
    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-5">

        <p class="text-gray-400 text-sm mb-2">
            Format
        </p>

        <h3 class="text-4xl font-bold mb-2">
            {{ $format }}%
        </h3>

        <p class="text-sm text-gray-300 mb-3">
            Tampilan aplikasi
        </p>

        <div class="w-full bg-gray-700 rounded-full h-2 mb-2">

            <div class="{{ warna($format) }} h-2 rounded-full"
                 style="width: {{ $format }}%">

            </div>

        </div>

        <span class="text-sm font-semibold">
            {{ kategori($format) }}
        </span>

    </div>

    {{-- EASE OF USE --}}
    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-5">

        <p class="text-gray-400 text-sm mb-2">
            Ease of Use
        </p>

        <h3 class="text-4xl font-bold mb-2">
            {{ $ease }}%
        </h3>

        <p class="text-sm text-gray-300 mb-3">
            Kemudahan penggunaan aplikasi
        </p>

        <div class="w-full bg-gray-700 rounded-full h-2 mb-2">

            <div class="{{ warna($ease) }} h-2 rounded-full"
                 style="width: {{ $ease }}%">

            </div>

        </div>

        <span class="text-sm font-semibold">
            {{ kategori($ease) }}
        </span>

    </div>

    {{-- TIMELINESS --}}
    <div class="bg-gray-800 border border-gray-700 rounded-2xl p-5">

        <p class="text-gray-400 text-sm mb-2">
            Timeliness
        </p>

        <h3 class="text-4xl font-bold mb-2">
            {{ $time }}%
        </h3>

        <p class="text-sm text-gray-300 mb-3">
            Kecepatan respon aplikasi
        </p>

        <div class="w-full bg-gray-700 rounded-full h-2 mb-2">

            <div class="{{ warna($time) }} h-2 rounded-full"
                 style="width: {{ $time }}%">

            </div>

        </div>

        <span class="text-sm font-semibold">
            {{ kategori($time) }}
        </span>

    </div>

</div>

{{-- =========================
KESIMPULAN
========================= --}}
<div class="bg-gradient-to-r
            from-blue-900/40
            to-indigo-900/40
            border border-blue-800
            rounded-2xl
            p-6
            mb-8">

    <h3 class="text-xl font-bold mb-3">
        Kesimpulan Analisis
    </h3>

    <p class="text-gray-200 leading-8">

        Berdasarkan hasil analisis metode
        <strong>End User Computing Satisfaction (EUCS)</strong>,
        tingkat kepuasan pengguna aplikasi
        <strong>Coretax</strong>

        memperoleh rata-rata sebesar

        <strong class="text-2xl">
            {{ $average }}%
        </strong>

        dengan kategori

        <strong>
            "{{ kategori($average) }}"
        </strong>.

    </p>

</div>

{{-- =========================
CHART
========================= --}}
<div class="bg-gray-800 border border-gray-700 rounded-2xl p-6">

    <h3 class="text-xl font-bold mb-6">
        Grafik EUCS
    </h3>

    <canvas id="eucsChart" height="120"></canvas>

</div>

<script>

new Chart(
    document.getElementById('eucsChart'),
    {

        type: 'bar',

        data: {

            labels: [

                'Content',
                'Accuracy',
                'Format',
                'Ease of Use',
                'Timeliness'

            ],

            datasets: [{

                label: 'Persentase',

                data: [

                    {{ $content }},
                    {{ $accuracy }},
                    {{ $format }},
                    {{ $ease }},
                    {{ $time }}

                ],

                borderWidth: 2

            }]

        },

        options: {

            responsive: true,

            scales: {

                y: {

                    beginAtZero: true,

                    max: 100

                }

            }

        }

    }

);

</script>

@endif

@endsection
