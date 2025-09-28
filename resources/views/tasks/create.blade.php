@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Buat Tugas Baru</h2>

                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul Tugas</label>
                        <input type="text" name="title" id="title" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" id="description" rows="4" required
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="deadline" class="block text-sm font-medium text-gray-700">Tenggat Waktu</label>
                            <input type="date" name="deadline" id="deadline" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="priority" class="block text-sm font-medium text-gray-700">Prioritas</label>
                            <select name="priority" id="priority" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                <option value="low">Rendah</option>
                                <option value="medium" selected>Sedang</option>
                                <option value="high">Tinggi</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tugaskan ke User</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 max-h-60 overflow-y-auto p-2 border border-gray-300 rounded-md">
                            @foreach($users as $user)
                            <div class="flex items-center">
                                <input type="checkbox" name="assigned_users[]" value="{{ $user->id }}" id="user-{{ $user->id }}"
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <label for="user-{{ $user->id }}" class="ml-2 text-sm text-gray-700">{{ $user->name }} ({{ $user->email }})</label>
                            </div>
                            @endforeach
                        </div>
                        @if($users->isEmpty())
                            <p class="text-sm text-gray-500">Belum ada user dengan role 'user'.</p>
                        @endif
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('tasks.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md mr-2">Batal</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
                            Simpan Tugas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection