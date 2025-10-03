@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Buat Laporan Publik</h2>

                <form action="{{ route('reports.store') }}" method="POST">
                    @csrf

                    <div class="mb-5">
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul Laporan</label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            required
                            value="{{ old('title') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            placeholder="Contoh: Server Error, Barang Hilang, dll"
                        >
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="type" class="block text-sm font-medium text-gray-700">Jenis Laporan</label>
                        <select
                            name="type"
                            id="type"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                        >
                            <option value="">-- Pilih Jenis --</option>
                            <option value="general" {{ old('type') == 'general' ? 'selected' : '' }}>Pengumuman Umum</option>
                            <option value="obstacle" {{ old('type') == 'obstacle' ? 'selected' : '' }}>Kendala Pekerjaan</option>
                            <option value="lost_item" {{ old('type') == 'lost_item' ? 'selected' : '' }}>Barang Hilang</option>
                            <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="content" class="block text-sm font-medium text-gray-700">Isi Laporan</label>
                        <textarea
                            name="content"
                            id="content"
                            rows="6"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            placeholder="Jelaskan secara detail laporan Anda..."
                        >{{ old('content') }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ url()->previous() }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md">
                            Batal
                        </a>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md">
                            Kirim Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection