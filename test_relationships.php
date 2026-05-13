<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Project;
use App\Models\Task;

echo "Testing project-task relationships:\n";
echo "----------------------------------\n";

$project = Project::first();
if ($project) {
    echo "Project: {$project->name} (ID: {$project->id})\n";
    echo "Tasks count: {$project->tasks->count()}\n";
    
    if ($project->tasks->count() > 0) {
        echo "\nFirst task:\n";
        $task = $project->tasks->first();
        echo "  Title: {$task->title}\n";
        echo "  Status: {$task->status}\n";
    }
} else {
    echo "No projects found!\n";
}
