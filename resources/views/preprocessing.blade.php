@extends('layouts.app')

@section('title', 'Preprocessing')

@section('content')

<h2 class="text-2xl font-bold mb-6">
    Hasil Preprocessing
</h2>

<div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-gray-900">

                <tr>

                    <th class="px-4 py-3 text-left">
                        Username
                    </th>

                    <th class="px-4 py-3 text-left">
                        Original
                    </th>

                    <th class="px-4 py-3 text-left">
                        Cleaning
                    </th>

                    <th class="px-4 py-3 text-left">
                        Tokenizing
                    </th>

                    <th class="px-4 py-3 text-left">
                        Stopword
                    </th>

                    <th class="px-4 py-3 text-left">
                        Stemming
                    </th>

                    <th class="px-4 py-3 text-left">
                        Final
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-gray-700">

                @forelse($results as $row)

                    <tr class="hover:bg-gray-700/40">

                        <td class="px-4 py-3">
                            {{ $row['username'] }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $row['content'] }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $row['cleaning'] }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $row['tokenizing'] }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $row['stopword'] }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $row['stemming'] }}
                        </td>

                        <td class="px-4 py-3 text-green-400">
                            {{ $row['final'] }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7"
                            class="px-4 py-8 text-center text-gray-500">

                            Dataset belum tersedia

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
