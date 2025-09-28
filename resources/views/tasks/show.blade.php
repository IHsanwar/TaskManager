@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $task->title }}</h2>
                        <p class="text-sm text-gray-500">Dibuat oleh: {{ $task->creator->name }} pada {{ $task->created_at->format('d M Y') }}</p>
                    </div>
                    <a href="{{ route('tasks.index') }}" class="text-blue-600 hover:underline">&larr; Kembali ke Daftar</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="font-semibold text-gray-700">Deskripsi</h3>
                        <p class="mt-1 text-gray-800">{{ $task->description }}</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700">Detail</h3>
                        <p><strong>Deadline:</strong> {{ $task->deadline->format('d M Y') }}</p>
                        <p><strong>Prioritas:</strong> 
                            <span class="px-2 py-1 rounded text-white text-xs
                                @if($task->priority === 'high') bg-red-500
                                @elseif($task->priority === 'medium') bg-yellow-500
                                @else bg-green-500 @endif">
                                {{ ucfirst($task->priority) }}
                            </span>
                        </p>
                    </div>
                </div>

                <h3 class="text-xl font-semibold mb-4">Status Penugasan</h3>
                @if($task->assignedUsers->isEmpty())
                    <p class="text-gray-500">Tugas ini belum ditugaskan ke siapa pun.</p>
                @else
                    <div class="space-y-4">
                        @foreach($task->assignedUsers as $user)
                            @php
                                $pivot = $user->pivot;
                            @endphp
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between">
                                    <h4 class="font-medium">{{ $user->name }}</h4>
                                    @if($pivot->is_completed)
                                        <span class="text-green-600 font-medium">✅ Selesai</span>
                                    @else
                                        <span class="text-yellow-600">⏳ Belum Selesai</span>
                                    @endif
                                </div>

                                @if($pivot->is_completed)
                                    <div class="mt-2 text-sm text-gray-700">
                                        <p><strong>Selesai pada:</strong> {{ $pivot->completed_at->format('d M Y H:i') }}</p>
                                        
                                        @if($pivot->notes)
                                            <p><strong>Catatan:</strong> {{ $pivot->notes }}</p>
                                        @endif

                                        @if($pivot->attachment_path)
                                            <p class="mt-2">
                                                <a href="{{ asset('storage/' . $pivot->attachment_path) }}" 
                                                   target="_blank"
                                                   class="text-blue-600 hover:underline">
                                                    📎 Lihat Lampiran
                                                </a>
                                            </p>
                                        @endif

                                        <!-- Form Verifikasi (Admin Only) -->
                                        @if(auth()->user()->role === 'admin' && !$pivot->verified_at)
                                            <form action="{{ route('tasks.verify', $task) }}" method="POST" class="mt-3">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">
                                                    Verifikasi Hasil
                                                </button>
                                            </form>
                                        @elseif($pivot->verified_at)
                                            <p class="mt-2 text-sm text-green-700">✅ Sudah diverifikasi</p>
                                        @endif
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500 mt-2">Menunggu pengerjaan...</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection