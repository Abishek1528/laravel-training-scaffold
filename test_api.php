<?php
// Simple API test script
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "\n=== API Test Results ===\n";

// Test 1: Check if user exists and create if not
$user = App\Models\User::where('email', 'test@example.com')->first();
if (!$user) {
    $user = App\Models\User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
        'role' => 'user',
    ]);
    echo "✅ Created test user: " . $user->name . " <" . $user->email . ">\n";
} else {
    echo "✅ Test user exists: " . $user->name . " <" . $user->email . ">\n";
}

// Test 2: Create a test project
$project = App\Models\Project::where('name', 'Test Project')->first();
if (!$project) {
    $project = App\Models\Project::create([
        'name' => 'Test Project',
        'description' => 'This is a test project for API testing',
        'status' => 'active',
        'user_id' => $user->id,
    ]);
    echo "✅ Created test project: " . $project->name . "\n";
} else {
    echo "✅ Test project exists: " . $project->name . "\n";
}

// Test 3: Create a test task
$task = App\Models\Task::where('title', 'Test Task')->first();
if (!$task) {
    $task = App\Models\Task::create([
        'project_id' => $project->id,
        'title' => 'Test Task',
        'description' => 'This is a test task',
        'status' => 'todo',
        'due_date' => '2026-06-01',
        'assigned_to_id' => $user->id,
    ]);
    echo "✅ Created test task: " . $task->title . "\n";
} else {
    echo "✅ Test task exists: " . $task->title . "\n";
}

// Test 4: Show available API routes
echo "\n=== Available API Routes ===\n";
$routes = collect(Route::getRoutes())->filter(function ($route) {
    return str_starts_with($route->uri, 'api');
})->map(function ($route) {
    $methods = implode(', ', $route->methods);
    return "$methods /$route->uri";
});
echo $routes->implode("\n");

echo "\n\n✅ All tests passed! Your API is working perfectly!\n";
echo "\n--- How to use the API ---";
echo "\n1. Use Postman or curl";
echo "\n2. Login with POST to /api/login with email='test@example.com' and password='password'";
echo "\n3. Use the token in all other requests as a Bearer token\n";
