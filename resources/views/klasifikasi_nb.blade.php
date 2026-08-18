@extends('layouts.app')

@section('title', 'Klasifikasi Naïve Bayes')

@section('content')

<!-- HEADER -->
<div class="flex justify-between items-center mb-6">

    <div class="flex items-center gap-4">

        <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">

            <span class="material-symbols-outlined text-blue-700 text-2xl">
                psychology
            </span>

        </div>

        <div>

            <h2 class="text-2xl font-bold text-slate-800">
                Klasifikasi Naïve Bayes
            </h2>

            <p class="text-slate-500 mt-1">
                Hasil klasifikasi menggunakan metode Naïve Bayes
            </p>

        </div>

    </div>

    <span class="hidden sm:inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-50 border border-blue-200 text-blue-700 text-xs font-semibold">
        <span class="w-2 h-2 rounded-full bg-blue-500"></span>
        Model Probabilistik
    </span>

</div>

<!-- AKURASI -->
<div class="bg-white rounded-2xl border border-blue-100 p-6 mb-6 premium-shadow">

    <div class="flex items-center justify-between mb-5">

        <div>

            <p class="text-sm text-slate-500">
                Akurasi Model
            </p>

            <p class="text-4xl font-bold text-blue-700 mt-1">
                {{ number_format($accuracy, 2) }}%
            </p>

            <p class="text-xs text-slate-400 mt-1">
                Diukur dari data uji hasil klasifikasi
            </p>

        </div>

        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center shadow-lg shadow-blue-200">

            <span class="material-symbols-outlined text-white text-3xl">
                psychology
            </span>

        </div>

    </div>

    <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden">

        <div
            class="h-full bg-gradient-to-r from-blue-500 to-blue-700 rounded-full transition-all duration-700"
            style="width: {{ min($accuracy, 100) }}%"
        ></div>

    </div>

</div>

<!-- EMPTY STATE -->
@if(count($results) == 0)

<div class="bg-white rounded-2xl border-2 border-dashed border-blue-200 p-10 text-center">

    <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center mx-auto">

        <span class="material-symbols-outlined text-4xl text-blue-400">
            inbox
        </span>

    </div>

    <p class="text-slate-600 font-medium mt-4">
        Belum ada hasil klasifikasi
    </p>

    <p class="text-slate-400 text-sm mt-1">
        Upload dataset terlebih dahulu untuk melihat hasil klasifikasi Naïve Bayes.
    </p>

</div>

@endif

@endsection
