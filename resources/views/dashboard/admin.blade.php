@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>

    <!-- Tasks Section -->
    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-4">Tasks</h2>
        <div class="bg-white shadow rounded p-4">
            @forelse($tasks as $task)
                <div class="border-b py-2">
                    <div class="font-bold">{{ $task->title }}</div>
                    <div class="text-sm text-gray-600">Created by: {{ $task->creator->name ?? '-' }}</div>
                    <div class="text-sm">Assigned to: 
                        @foreach($task->assignedUsers as $user)
                            <span class="bg-gray-200 px-2 py-1 rounded">{{ $user->name }}</span>
                        @endforeach
                    </div>
                </div>
            @empty
                <div>No tasks found.</div>
            @endforelse
            <div class="mt-4">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>

    <!-- Announcements Section -->
    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-4">Announcements</h2>
        <div class="bg-white shadow rounded p-4">
            @forelse($announcements as $announcement)
                <div class="border-b py-2">
                    <div class="font-bold">{{ $announcement->title }}</div>
                    <div class="text-sm text-gray-600">{{ $announcement->created_at->format('d M Y') }}</div>
                    <div>{{ $announcement->content }}</div>
                </div>
            @empty
                <div>No announcements found.</div>
            @endforelse
            <div class="mt-4">
                {{ $announcements->links() }}
            </div>
        </div>
    </div>

    <!-- Reports Section -->
    <div>
        <h2 class="text-xl font-semibold mb-4">Public Reports</h2>
        <div class="bg-white shadow rounded p-4">
            @forelse($reports as $report)
                <div class="border-b py-2">
                    <div class="font-bold">{{ $report->title }}</div>
                    <div class="text-sm text-gray-600">By: {{ $report->creator->name ?? '-' }}</div>
                    <div>{{ $report->description }}</div>
                </div>
            @empty
                <div>No reports found.</div>
            @endforelse
            <div class="mt-4">
                {{ $reports->links() }}
            </div>
        </div>
    </div>
</div>
@endsection