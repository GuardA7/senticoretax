@extends('layouts.app')

@section('title', 'Klasifikasi SVM')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>

        <h2 class="text-2xl font-bold">
            Klasifikasi SVM
        </h2>

        <p class="text-gray-400 mt-1">
            Hasil klasifikasi menggunakan Support Vector Machine
        </p>

    </div>

</div>

<!-- AKURASI -->
<div class="bg-gray-800 rounded-xl border border-gray-700 p-5 mb-6">

    <div class="flex items-center justify-between">

        <div>

            <p class="text-sm text-gray-400">
                Akurasi Model
            </p>

            <p class="text-3xl font-bold text-indigo-400">
                {{ number_format($accuracy , 2) }}%
            </p>

        </div>

        <div class="w-14 h-14 rounded-xl bg-indigo-500/20 flex items-center justify-center">

            <span class="material-symbols-outlined text-indigo-400 text-3xl">
                psychology
            </span>

        </div>

    </div>

</div>

<!-- EMPTY STATE -->
@if(count($results) == 0)

<div class="bg-gray-800 rounded-xl border border-gray-700 p-8 text-center">

    <span class="material-symbols-outlined text-5xl text-gray-500">
        inbox
    </span>

    <p class="text-gray-400 mt-3">
        Belum ada hasil klasifikasi.
    </p>

</div>

@endif

@endsection
