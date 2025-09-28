@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Manajemen Tugas</h2>
                    <a href="{{ route('tasks.create') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition">
                        + Buat Tugas Baru
                    </a>
                </div>

                @if(session('success'))
                    <div class="mb-4 bg-green-100 text-green-800 p-3 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                @if($tasks->isEmpty())
                    <p class="text-gray-500">Belum ada tugas.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deadline</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prioritas</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ditugaskan ke</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($tasks as $task)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-medium text-gray-900">{{ $task->title }}</div>
                                        <div class="text-sm text-gray-500">Oleh: {{ $task->creator->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700 max-w-xs">
                                        {{ Str::limit($task->description, 50) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if($task->priority === 'high') bg-red-100 text-red-800
                                            @elseif($task->priority === 'medium') bg-yellow-100 text-yellow-800
                                            @else bg-green-100 text-green-800 @endif">
                                            {{ ucfirst($task->priority) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        @if($task->assignedUsers->isEmpty())
                                            <span class="text-gray-400">Belum ditugaskan</span>
                                        @else
                                            <ul class="list-disc list-inside">
                                                @foreach($task->assignedUsers as $user)
                                                    <li>{{ $user->name }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $completedCount = $task->assignedUsers->where('pivot.is_completed', true)->count();
                                            $totalCount = $task->assignedUsers->count();
                                        @endphp
                                        @if($totalCount === 0)
                                            <span class="text-gray-500">–</span>
                                        @else
                                            <span class="text-sm font-medium">
                                                {{ $completedCount }}/{{ $totalCount }} selesai
                                            </span>
                                            @if($completedCount > 0)
                                                <span class="ml-2 text-green-600">✅</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('tasks.show', $task) }}" class="text-blue-600 hover:text-blue-900 mr-3">Lihat</a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900"
                                                    onclick="return confirm('Hapus tugas ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $tasks->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection