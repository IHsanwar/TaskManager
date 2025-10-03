@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Dashboard User</h2>

<!-- Announcements -->
<div class="mb-8">
    <h3 class="text-xl font-semibold mb-2">Pengumuman</h3>
    @forelse($announcements as $ann)
        <div class="bg-white p-4 rounded shadow mb-3">
            <h4 class="font-bold">{{ $ann->title }}</h4>
            <p>{{ $ann->content }}</p>
            <small class="text-gray-500">Dibuat: {{ $ann->created_at->format('d M Y') }}</small>
        </div>
    @empty
        <p class="text-gray-500">Tidak ada pengumuman.</p>
    @endforelse
</div>

<!-- Assigned Tasks -->
<h3 class="text-xl font-semibold mb-2">Tugas Saya</h3>
@forelse($assignedTasks as $task)
    <div class="bg-white p-4 rounded shadow mb-4">
        <h4 class="font-bold">{{ $task->title }}</h4>
        <p>{{ Str::limit($task->description, 100) }}</p>
        <p><strong>Deadline:</strong> {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}</p>
        <p><strong>Prioritas:</strong> 
            <span class="px-2 py-1 rounded text-white 
                @if($task->priority === 'high') bg-red-500
                @elseif($task->priority === 'medium') bg-yellow-500
                @else bg-green-500 @endif">
                {{ ucfirst($task->priority) }}
            </span>
        </p>

        @php
            $pivot = $task->assignedUsers->firstWhere('id', auth()->id())?->pivot;
        @endphp

        @if($pivot && $pivot->is_completed)
            <p class="text-green-600 mt-2">✅ Selesai pada {{ \Carbon\Carbon::parse($pivot->completed_at)->format('d M Y') }}</p>
            @if($pivot->attachment_path)
                <a href="{{ asset('storage/' . $pivot->attachment_path) }}" target="_blank" class="text-blue-600">Lihat Lampiran</a>
            @endif
            @if($pivot->notes)
                <p class="mt-1"><strong>Catatan:</strong> {{ $pivot->notes }}</p>
            @endif
        @else
            <form action="{{ route('tasks.complete', $task) }}" method="POST" enctype="multipart/form-data" class="mt-3">
                @csrf
                <textarea name="notes" placeholder="Catatan tambahan (opsional)" class="w-full p-2 border rounded mb-2"></textarea>
                <input type="file" name="attachment" class="mb-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Selesaikan Tugas</button>
            </form>
        @endif
    </div>
@empty
    <p class="text-gray-500">Belum ada tugas yang diberikan.</p>
@endforelse

<!-- Public Reports -->
<a href="{{ route('reports.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">+ Buat Laporan Publik</a>
@endsection