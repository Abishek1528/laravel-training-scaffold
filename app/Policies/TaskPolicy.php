<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Task $task): bool
    {
        // Allow all logged-in users to view any task
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Task $task): bool
    {
        return $user->id === $task->project->user_id || $task->project->members->contains($user->id);
    }

    public function delete(User $user, Task $task): bool
    {
        return $user->id === $task->project->user_id;
    }