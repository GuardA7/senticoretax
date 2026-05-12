@extends('layouts.app')

@section('title', 'Analisis EUCS')

@section('content')
<h2 class="text-2xl font-bold mb-6">Analisis EUCS</h2>
<p class="text-gray-400 mb-4">End User Computing Satisfaction - Tingkat Kepuasan Pengguna</p>

<div class="bg-gray-800 rounded-xl border border-gray-700 p-5 mb-6">
    <div class="text-center">
        <p class="text-gray-400">Tingkat Kepuasan Keseluruhan</p>
        <p class="text-4xl font-bold text-green-400">{{ number_format($kepuasan, 2) }}%</p>
        <p class="text-sm text-gray-500">Berdasarkan {{ $positif }} ulasan positif dari {{ $total }} total</p>
    </div>
</div>

<div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-900">
                <tr>
                    <th class="px-4 py-3 text-left">Dimensi EUCS</th>
                    <th class="px-4 py-3 text-center">Puas</th>
                    <th class="px-4 py-3 text-center">Tidak Puas</th>
                    <th class="px-4 py-3 text-center">Kepuasan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @foreach($eucsMetrics as $dimension => $values)
                <tr>
                    <td class="px-4 py-3">{{ $dimension }}</td>
                    <td class="px-4 py-3 text-center">{{ number_format($values['puas'], 2) }}</td>
                    <td class="px-4 py-3 text-center">{{ number_format($values['tidak_puas'], 2) }}</td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex items-center gap-2">
                            <div class="flex-1 h-2 bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full bg-green-500 rounded-full" style="width: {{ ($values['puas'] / max($values['puas'] + $values['tidak_puas'], 1)) * 100 }}%"></div>
                            </div>
                            <span class="text-xs">{{ number_format(($values['puas'] / max($values['puas'] + $values['tidak_puas'], 1)) * 100, 1) }}%</span>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4 p-3 bg-gray-800 rounded-lg text-xs text-gray-400">
    <p class="font-semibold mb-1">📝 Keterangan:</p>
    <p>EUCS mengukur kepuasan pengguna berdasarkan 5 dimensi: Content (isi informasi), Accuracy (akurasi), Format (tampilan), Ease of Use (kemudahan), Timeliness (ketepatan waktu).</p>
</div>
@endsection
