<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        
        Project::factory()->count(10)->create([
            'user_id' => fn() => $users->random()->id
        ]);
    }
}