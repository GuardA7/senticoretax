@extends('layouts.app')

@section('title', 'Preprocessing')

@section('content')

<h2 class="text-3xl font-bold mb-6 text-white">
    Hasil Preprocessing
</h2>

<div class="bg-gray-800 border border-gray-700 rounded-2xl overflow-hidden">

    <div class="overflow-x-auto">

        <table class="min-w-full text-sm text-gray-200">

            <thead class="bg-gray-900 text-white sticky top-0">

                <tr>

                    <th class="px-4 py-4 text-left min-w-[120px]">
                        Username
                    </th>

                    <th class="px-4 py-4 text-left min-w-[350px]">
                        Original
                    </th>

                    <th class="px-4 py-4 text-left min-w-[300px]">
                        Cleaning
                    </th>

                    <th class="px-4 py-4 text-left min-w-[300px]">
                        Tokenizing
                    </th>

                    <th class="px-4 py-4 text-left min-w-[300px]">
                        Stopword
                    </th>

                    <th class="px-4 py-4 text-left min-w-[300px]">
                        Stemming
                    </th>

                    <th class="px-4 py-4 text-left min-w-[300px]">
                        Final
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-gray-700">

                @forelse($results as $row)

                    <tr class="hover:bg-gray-700/40 align-top">

                        {{-- USERNAME --}}
                        <td class="px-4 py-4 whitespace-normal">
                            {{ $row['username'] }}
                        </td>

                        {{-- ORIGINAL --}}
                        <td class="px-4 py-4">
                            <div class="max-h-40 overflow-y-auto whitespace-pre-wrap break-words">
                                {{ $row['content'] }}
                            </div>
                        </td>

                        {{-- CLEANING --}}
                        <td class="px-4 py-4 text-cyan-300">
                            <div class="max-h-40 overflow-y-auto whitespace-pre-wrap break-words">
                                {{ $row['cleaning'] }}
                            </div>
                        </td>

                        {{-- TOKENIZING --}}
                        <td class="px-4 py-4 text-yellow-300">
                            <div class="max-h-40 overflow-y-auto whitespace-pre-wrap break-words">
                                {{ $row['tokenizing'] }}
                            </div>
                        </td>

                        {{-- STOPWORD --}}
                        <td class="px-4 py-4 text-pink-300">
                            <div class="max-h-40 overflow-y-auto whitespace-pre-wrap break-words">
                                {{ $row['stopword'] }}
                            </div>
                        </td>

                        {{-- STEMMING --}}
                        <td class="px-4 py-4 text-orange-300">
                            <div class="max-h-40 overflow-y-auto whitespace-pre-wrap break-words">
                                {{ $row['stemming'] }}
                            </div>
                        </td>

                        {{-- FINAL --}}
                        <td class="px-4 py-4 text-green-400 font-medium">
                            <div class="max-h-40 overflow-y-auto whitespace-pre-wrap break-words">
                                {{ $row['final'] }}
                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7"
                            class="px-4 py-10 text-center text-gray-400">

                            Dataset belum tersedia

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
