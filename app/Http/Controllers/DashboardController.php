<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Announcement;
use App\Models\PublicReport;

class DashboardController extends Controller
{
    
    public function index()
{
    $user = auth()->user();

    if ($user->role === 'admin') {
        $tasks = Task::with('creator', 'assignedUsers')->latest()->paginate(5);
        $announcements = Announcement::latest()->paginate(3);
        $reports = PublicReport::with('creator')->latest()->paginate(5);
        return view('dashboard.admin', compact('tasks', 'announcements', 'reports'));
    } else {
        $assignedTasks = $user->tasksAssigned()->with('creator')->latest()->paginate(5);
        $announcements = Announcement::latest()->get();
        $reports = PublicReport::with('creator')->latest()->paginate(5);
        return view('dashboard.user', compact('assignedTasks', 'announcements', 'reports'));
    }
}
}
