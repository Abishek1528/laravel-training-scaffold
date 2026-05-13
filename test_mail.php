<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Log in as Alice
Auth::loginUsingId(6);

// Get a task
$task = App\Models\Task::first();
$assignee = $task->assignee ?? App\Models\User::first();

echo "Testing mail to: " . $assignee->email . PHP_EOL;

try {
    // Send mail directly (no queue)
    Illuminate\Support\Facades\Mail::to($assignee->email)->send(new App\Mail\TaskAssigned($task));
    echo "✅ Mail sent successfully!" . PHP_EOL;
} catch (Exception $e) {
    echo "❌ Mail failed: " . $e->getMessage() . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
}
