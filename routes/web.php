<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\PublicReportController;

// Halaman publik
Route::view('/', 'welcome');

// Route auth (otomatis dari Breeze)
require __DIR__.'/auth.php';

// Route terproteksi
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Task: hanya admin yang bisa kelola
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('tasks', TaskController::class);
        Route::post('tasks/{task}/assign', [TaskController::class, 'assign'])->name('tasks.assign');
        Route::post('tasks/{task}/verify', [TaskController::class, 'verify'])->name('tasks.verify');
        Route::get('/list-user',[DashboardController::class, 'userList'])->name('list-user');
    });

    // User: selesaikan tugas
    Route::middleware(['role:user'])->post('tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');

    // Announcement: admin only
    Route::middleware(['role:admin'])->resource('announcements', AnnouncementController::class);

    
    Route::resource('reports', PublicReportController::class);
    
    // profile
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
    
});