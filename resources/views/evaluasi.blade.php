@extends('layouts.app')

@section('title', 'Evaluasi Model')

@section('content')

<h2 class="text-3xl font-bold mb-6 text-white">
    Evaluasi Model
</h2>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- ========================= -->
    <!-- NAIVE BAYES -->
    <!-- ========================= -->
    <div class="bg-gray-800 rounded-2xl border border-gray-700 p-6">

        <h3 class="text-xl font-bold mb-5 text-blue-400">
            Naïve Bayes
        </h3>

        <!-- Accuracy -->
        <div class="mb-5 p-5 bg-gray-700/40 rounded-xl">

            <p class="text-center text-4xl font-bold text-white">
                {{ number_format($nbMetrics['accuracy'], 2) }}%
            </p>

            <p class="text-center text-gray-400 mt-1">
                Accuracy
            </p>

        </div>

        <!-- Metrics -->
        <table class="w-full text-sm">

            <thead class="bg-gray-900">

                <tr>

                    <th class="px-4 py-3 text-left">
                        Metric
                    </th>

                    <th class="px-4 py-3 text-center">
                        Value
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-gray-700">

                <tr>

                    <td class="px-4 py-3">
                        Precision
                    </td>

                    <td class="px-4 py-3 text-center text-cyan-400">
                        {{ number_format($nbMetrics['precision'], 2) }}%
                    </td>

                </tr>

                <tr>

                    <td class="px-4 py-3">
                        Recall
                    </td>

                    <td class="px-4 py-3 text-center text-yellow-400">
                        {{ number_format($nbMetrics['recall'], 2) }}%
                    </td>

                </tr>

                <tr>

                    <td class="px-4 py-3">
                        F1-Score
                    </td>

                    <td class="px-4 py-3 text-center text-pink-400">
                        {{ number_format($nbMetrics['f1_score'], 2) }}%
                    </td>

                </tr>

            </tbody>

        </table>

        <!-- Confusion Matrix -->
        <h4 class="font-semibold mt-6 mb-3 text-white">
            Confusion Matrix
        </h4>

        <table class="w-full text-sm text-center">

            <tr class="bg-gray-900">

                <th class="p-3"></th>

                <th class="p-3">
                    Positif
                </th>

                <th class="p-3">
                    Negatif
                </th>

                <th class="p-3">
                    Netral
                </th>

            </tr>

            @foreach(['positif', 'negatif', 'netral'] as $actual)

                <tr class="border-t border-gray-700">

                    <th class="p-3 bg-gray-900">
                        {{ ucfirst($actual) }}
                    </th>

                    @foreach(['positif', 'negatif', 'netral'] as $pred)

                        <td class="p-3">
                            {{ $nbConfusion[$actual][$pred] ?? 0 }}
                        </td>

                    @endforeach

                </tr>

            @endforeach

        </table>

    </div>

    <!-- ========================= -->
    <!-- SVM -->
    <!-- ========================= -->
    <div class="bg-gray-800 rounded-2xl border border-gray-700 p-6">

        <h3 class="text-xl font-bold mb-5 text-indigo-400">
            SVM
        </h3>

        <!-- Accuracy -->
        <div class="mb-5 p-5 bg-gray-700/40 rounded-xl">

            <p class="text-center text-4xl font-bold text-white">
                {{ number_format($svmMetrics['accuracy'], 2) }}%
            </p>

            <p class="text-center text-gray-400 mt-1">
                Accuracy
            </p>

        </div>

        <!-- Metrics -->
        <table class="w-full text-sm">

            <thead class="bg-gray-900">

                <tr>

                    <th class="px-4 py-3 text-left">
                        Metric
                    </th>

                    <th class="px-4 py-3 text-center">
                        Value
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-gray-700">

                <tr>

                    <td class="px-4 py-3">
                        Precision
                    </td>

                    <td class="px-4 py-3 text-center text-cyan-400">
                        {{ number_format($svmMetrics['precision'], 2) }}%
                    </td>

                </tr>

                <tr>

                    <td class="px-4 py-3">
                        Recall
                    </td>

                    <td class="px-4 py-3 text-center text-yellow-400">
                        {{ number_format($svmMetrics['recall'], 2) }}%
                    </td>

                </tr>

                <tr>

                    <td class="px-4 py-3">
                        F1-Score
                    </td>

                    <td class="px-4 py-3 text-center text-pink-400">
                        {{ number_format($svmMetrics['f1_score'], 2) }}%
                    </td>

                </tr>

            </tbody>

        </table>

        <!-- Confusion Matrix -->
        <h4 class="font-semibold mt-6 mb-3 text-white">
            Confusion Matrix
        </h4>

        <table class="w-full text-sm text-center">

            <tr class="bg-gray-900">

                <th class="p-3"></th>

                <th class="p-3">
                    Positif
                </th>

                <th class="p-3">
                    Negatif
                </th>

                <th class="p-3">
                    Netral
                </th>

            </tr>

            @foreach(['positif', 'negatif', 'netral'] as $actual)

                <tr class="border-t border-gray-700">

                    <th class="p-3 bg-gray-900">
                        {{ ucfirst($actual) }}
                    </th>

                    @foreach(['positif', 'negatif', 'netral'] as $pred)

                        <td class="p-3">
                            {{ $svmConfusion[$actual][$pred] ?? 0 }}
                        </td>

                    @endforeach

                </tr>

            @endforeach

        </table>

    </div>

</div>

@endsection
