@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Laporan Publik</h2>
                    @auth
                        <a href="{{ route('reports.create') }}"
                           class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md text-sm flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Buat Laporan
                        </a>
                    @endauth
                </div>

                @if(session('success'))
                    <div class="mb-4 bg-green-100 text-green-800 p-3 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                @if($reports->isEmpty())
                    <div class="text-center py-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="mt-4 text-gray-500">Belum ada laporan publik.</p>
                        @auth
                            <p class="text-gray-400 mt-2">Anda bisa membuat laporan pertama!</p>
                        @endauth
                    </div>
                @else
                    <div class="space-y-5">
                        @foreach($reports as $report)
                            <div class="border border-gray-200 rounded-lg p-5 hover:shadow-sm transition">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full
                                            @if($report->type === 'general') bg-blue-100 text-blue-800
                                            @elseif($report->type === 'obstacle') bg-yellow-100 text-yellow-800
                                            @elseif($report->type === 'lost_item') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            @if($report->type === 'general') Pengumuman Umum
                                            @elseif($report->type === 'obstacle') Kendala Pekerjaan
                                            @elseif($report->type === 'lost_item') Barang Hilang
                                            @else Lainnya
                                            @endif
                                        </span>
                                        <h3 class="text-lg font-semibold text-gray-900 mt-2">{{ $report->title }}</h3>
                                        <p class="text-gray-700 mt-2 whitespace-pre-line">{{ $report->content }}</p>
                                    </div>
                                </div>

                                <div class="mt-4 flex items-center text-sm text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>{{ $report->creator->name ?? 'User' }}</span>
                                    <span class="mx-2">•</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ $report->created_at->format('d M Y H:i') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                @endif
            </div>
        </div>
    </div>
</div>
@endsection 