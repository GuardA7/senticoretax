@extends('layouts.app')

@section('title', 'Evaluasi Model')

@section('content')
<h2 class="text-2xl font-bold mb-6">Evaluasi Model</h2>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Naïve Bayes -->
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
        <h3 class="text-lg font-semibold mb-4 text-blue-400">Naïve Bayes</h3>
        <div class="mb-4 p-3 bg-gray-700/50 rounded-lg">
            <p class="text-center text-2xl font-bold">{{ number_format($nbMetrics['accuracy'] * 100, 2) }}%</p>
            <p class="text-center text-sm text-gray-400">Akurasi</p>
        </div>
        <table class="w-full text-sm">
            <thead class="bg-gray-900">
                <tr>
                    <th class="px-3 py-2 text-left">Kelas</th>
                    <th class="px-3 py-2 text-center">Precision</th>
                    <th class="px-3 py-2 text-center">Recall</th>
                    <th class="px-3 py-2 text-center">F1-Score</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nbMetrics['by_class'] as $class => $m)
                <tr class="border-t border-gray-700">
                    <td class="px-3 py-2 capitalize">{{ $class }}</td>
                    <td class="px-3 py-2 text-center">{{ number_format($m['precision'] * 100, 2) }}%</td>
                    <td class="px-3 py-2 text-center">{{ number_format($m['recall'] * 100, 2) }}%</td>
                    <td class="px-3 py-2 text-center">{{ number_format($m['f1'] * 100, 2) }}%</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h4 class="font-semibold mt-4 mb-2">Confusion Matrix</h4>
        <table class="w-full text-sm text-center">
            <tr class="bg-gray-900">
                <th class="p-2"></th><th class="p-2">Positif</th><th class="p-2">Negatif</th><th class="p-2">Netral</th>
            </tr>
            @foreach(['positif', 'negatif', 'netral'] as $actual)
            <tr class="border-t border-gray-700">
                <th class="p-2 bg-gray-900">{{ ucfirst($actual) }}</th>
                @foreach(['positif', 'negatif', 'netral'] as $pred)
                <td class="p-2">{{ $nbConfusion[$actual][$pred] ?? 0 }}</td>
                @endforeach
            </tr>
            @endforeach
        </table>
    </div>

    <!-- SVM -->
    <div class="bg-gray-800 rounded-xl border border-gray-700 p-5">
        <h3 class="text-lg font-semibold mb-4 text-indigo-400">SVM</h3>
        <div class="mb-4 p-3 bg-gray-700/50 rounded-lg">
            <p class="text-center text-2xl font-bold">{{ number_format($svmMetrics['accuracy'] * 100, 2) }}%</p>
            <p class="text-center text-sm text-gray-400">Akurasi</p>
        </div>
        <table class="w-full text-sm">
            <thead class="bg-gray-900">
                <tr>
                    <th class="px-3 py-2 text-left">Kelas</th>
                    <th class="px-3 py-2 text-center">Precision</th>
                    <th class="px-3 py-2 text-center">Recall</th>
                    <th class="px-3 py-2 text-center">F1-Score</th>
                </tr>
            </thead>
            <tbody>
                @foreach($svmMetrics['by_class'] as $class => $m)
                <tr class="border-t border-gray-700">
                    <td class="px-3 py-2 capitalize">{{ $class }}</td>
                    <td class="px-3 py-2 text-center">{{ number_format($m['precision'] * 100, 2) }}%</td>
                    <td class="px-3 py-2 text-center">{{ number_format($m['recall'] * 100, 2) }}%</td>
                    <td class="px-3 py-2 text-center">{{ number_format($m['f1'] * 100, 2) }}%</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h4 class="font-semibold mt-4 mb-2">Confusion Matrix</h4>
        <table class="w-full text-sm text-center">
            <tr class="bg-gray-900">
                <th class="p-2"></th><th class="p-2">Positif</th><th class="p-2">Negatif</th><th class="p-2">Netral</th>
            </tr>
            @foreach(['positif', 'negatif', 'netral'] as $actual)
            <tr class="border-t border-gray-700">
                <th class="p-2 bg-gray-900">{{ ucfirst($actual) }}</th>
                @foreach(['positif', 'negatif', 'netral'] as $pred)
                <td class="p-2">{{ $svmConfusion[$actual][$pred] ?? 0 }}</td>
                @endforeach
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
