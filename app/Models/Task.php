<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Task extends Model
{
    protected $fillable = ['title', 'description', 'deadline', 'priority', 'created_by'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignedUsers()
    {
        return $this->belongsToMany(User::class, 'task_user')
            ->withPivot('is_completed', 'notes', 'attachment_path', 'completed_at', 'is_verified', 'verified_at')
            ->withTimestamps();
    }

    use Hasfactory;
}