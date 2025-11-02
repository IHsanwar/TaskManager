<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskUser;
class TaskController extends Controller
{
    // app/Http/Controllers/TaskController.php

public function index()
{
    $tasks = Task::with('creator', 'assignedUsers')->latest()->paginate(10);
    return view('tasks.index', compact('tasks'));
}

public function create()
{
    $users = User::where('role', 'user')->get();
    return view('tasks.create', compact('users'));
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'deadline' => 'required|date',
        'priority' => 'required|in:low,medium,high',
        'assigned_users' => 'required|array',
    ]);

    $task = Task::create([
        'title' => $request->title,
        'description' => $request->description,
        'deadline' => $request->deadline,
        'priority' => $request->priority,
        'created_by' => auth()->id(),
    ]);

    $task->assignedUsers()->attach($request->assigned_users);

    return redirect()->route('tasks.index')->with('success', 'Tugas berhasil dibuat!');
}

        public function verify(Request $request, Task $task)
    {
        // misal admin memverifikasi user_id tertentu dari form
        $userId = $request->input('user_id'); 

        $taskuser = TaskUser::where('task_id', $task->id)
                            ->where('user_id', $userId)
                            ->firstOrFail();

        $taskuser->is_verified = true;
        $taskuser->verified_at = now();
        $taskuser->save();

        return back()->with('success', 'Tugas user berhasil diverifikasi oleh admin!');
    }


public function complete(Request $request, Task $task)
{
    $request->validate([
        'notes' => 'nullable|string',
        'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240', // max 10MB
    ]);

    $attachmentPath = null;
    if ($request->hasFile('attachment')) {
        $attachmentPath = $request->file('attachment')->store('task_attachments', 'public');
    }

    $task->assignedUsers()->updateExistingPivot(auth()->id(), [
        'is_completed' => true,
        'notes' => $request->notes,
        'attachment_path' => $attachmentPath,
        'completed_at' => now(),
    ]);

    return back()->with('success', 'Tugas berhasil diselesaikan!');
}
   public function destroy(Task $task)
{
    // Hapus semua file lampiran dari setiap user di pivot table
    foreach ($task->assignedUsers as $user) {
        $pivot = $user->pivot;

        if ($pivot->attachment_path) {
            $filePath = storage_path('app/public/' . $pivot->attachment_path);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }

    // Hapus relasi dan task
    $task->assignedUsers()->detach();
    $task->delete();

    return back()->with('success', 'Tugas dan semua lampiran berhasil dihapus!');
}

    public function show(Task $task)
    {
        $task->load(['assignedUsers', 'creator']);
        return view('tasks.show', compact('task'));
    }
}