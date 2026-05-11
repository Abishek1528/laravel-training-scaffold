<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Creating New Test Users ===\n\n";

// User 1
$user1 = App\Models\User::create([
    'name' => 'Alice Smith',
    'email' => 'alice@example.com',
    'password' => Hash::make('password123'),
    'role' => 'user',
]);
echo "✅ User 1 created:\n";
echo "   Name: Alice Smith\n";
echo "   Email: alice@example.com\n";
echo "   Password: password123\n\n";

// User 2
$user2 = App\Models\User::create([
    'name' => 'Bob Johnson',
    'email' => 'bob@example.com',
    'password' => Hash::make('password123'),
    'role' => 'user',
]);
echo "✅ User 2 created:\n";
echo "   Name: Bob Johnson\n";
echo "   Email: bob@example.com\n";
echo "   Password: password123\n\n";

echo "=== All Users in Database ===\n";
$users = App\Models\User::all();
foreach ($users as $u) {
    echo "- ID: {$u->id} | Name: {$u->name} | Email: {$u->email}\n";
}
echo "\n✅ Done! You can use these credentials in Postman!\n";
