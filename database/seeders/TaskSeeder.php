<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all();
        $users = User::all();

        Task::factory()->count(30)->create([
            'project_id' => fn() => $projects->random()->id,
            'assigned_to_id' => fn() => $users->random()->id,
        ]);
    }
}