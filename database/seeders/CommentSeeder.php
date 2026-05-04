<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = Task::all();
        $users = User::all();

        Comment::factory()->count(50)->create([
            'task_id' => fn() => $tasks->random()->id,
            'user_id' => fn() => $users->random()->id,
        ]);
    }
}