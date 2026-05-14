<?php

use App\Models\User;
use App\Models\Task;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Projects Routes
    Route::resource('projects', ProjectController::class);
    
    // Tasks Routes (Nested under Projects)
    Route::get('projects/{project}/tasks', [TaskController::class, 'index'])->name('projects.tasks.index');
    Route::get('projects/{project}/tasks/create', [TaskController::class, 'create'])->name('projects.tasks.create');
    Route::post('projects/{project}/tasks', [TaskController::class, 'store'])->name('projects.tasks.store');
    Route::get('projects/{project}/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('projects/{project}/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('projects/{project}/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('projects/{project}/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    // Comment Route
    Route::post('comments', [TaskController::class, 'storeComment'])->name('comments.store');

 
    // Admin Only Routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            $totalTasks = Task::count();
            $totalUsers = User::count();
            $recentTasks = Task::latest()->first();
            $recentUsers = User::latest()->first();
            $pendingTasksCount = Task::where('status', 'todo')->count();
            $completedTasksCount = Task::where('status', 'completed')->count();
            $pendingUsersCount = User::whereNull('email_verified_at')->count(); // Example metric

            return view('adminhome', compact(
                'totalTasks', 
                'totalUsers', 
                'recentTasks', 
                'recentUsers', 
                'pendingTasksCount', 
                'completedTasksCount', 
                'pendingUsersCount'
            ));
        })->name('admin.dashboard');
    });
});

require __DIR__.'/auth.php';
