@extends('layouts.app')

@section('title', 'Preprocessing')

@section('content')

<h2 class="text-3xl font-bold mb-6 text-slate-800">
    Hasil Preprocessing
</h2>

<div class="bg-white border border-blue-100 rounded-2xl overflow-hidden premium-shadow">

    <div class="overflow-x-auto">

        <table class="min-w-full text-sm text-slate-700">

            <thead class="bg-blue-900 text-white sticky top-0">

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

            <tbody class="divide-y divide-blue-50">

                @forelse($results as $row)

                    <tr class="hover:bg-blue-50/60 align-top">

                        {{-- USERNAME --}}
                        <td class="px-4 py-4 whitespace-normal text-slate-700">
                            {{ $row['username'] }}
                        </td>

                        {{-- ORIGINAL --}}
                        <td class="px-4 py-4">
                            <div class="max-h-40 overflow-y-auto whitespace-pre-wrap break-words text-slate-600">
                                {{ $row['content'] }}
                            </div>
                        </td>

                        {{-- CLEANING --}}
                        <td class="px-4 py-4 text-cyan-700">
                            <div class="max-h-40 overflow-y-auto whitespace-pre-wrap break-words">
                                {{ $row['cleaning'] }}
                            </div>
                        </td>

                        {{-- TOKENIZING --}}
                        <td class="px-4 py-4 text-amber-600">
                            <div class="max-h-40 overflow-y-auto whitespace-pre-wrap break-words">
                                {{ $row['tokenizing'] }}
                            </div>
                        </td>

                        {{-- STOPWORD --}}
                        <td class="px-4 py-4 text-pink-600">
                            <div class="max-h-40 overflow-y-auto whitespace-pre-wrap break-words">
                                {{ $row['stopword'] }}
                            </div>
                        </td>

                        {{-- STEMMING --}}
                        <td class="px-4 py-4 text-orange-600">
                            <div class="max-h-40 overflow-y-auto whitespace-pre-wrap break-words">
                                {{ $row['stemming'] }}
                            </div>
                        </td>

                        {{-- FINAL --}}
                        <td class="px-4 py-4 text-green-700 font-medium">
                            <div class="max-h-40 overflow-y-auto whitespace-pre-wrap break-words">
                                {{ $row['final'] }}
                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7"
                            class="px-4 py-10 text-center text-slate-400">

                            Dataset belum tersedia

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
