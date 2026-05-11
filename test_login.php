<?php
// Test the login endpoint directly from PHP
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Test user credentials
$email = 'test@example.com';
$password = 'password';

// Get the user
$user = App\Models\User::where('email', $email)->first();

// Simulate a login request
echo "=== Testing API Login ===\n";
echo "Email: $email\n";
echo "Password: $password\n\n";

// Verify user exists
if (!$user) {
    echo "❌ User not found!\n";
    exit(1);
}

// Verify password
if (!Hash::check($password, $user->password)) {
    echo "❌ Incorrect password!\n";
    exit(1);
}

echo "✅ User authenticated successfully!\n";
echo "User ID: " . $user->id . "\n";
echo "User Name: " . $user->name . "\n\n";

// Create a token
$token = $user->createToken('api-token')->plainTextToken;

echo "✅ API Token created successfully!\n";
echo "Token: $token\n\n";

echo "=== Now Test with Postman ===\n";
echo "1. Send POST request to: http://127.0.0.1:8000/api/login\n";
echo "   with JSON body:\n";
echo "   {\n";
echo "     \"email\": \"$email\",\n";
echo "     \"password\": \"$password\"\n";
echo "   }\n\n";
echo "2. Use the returned token in all other requests as 'Bearer {token}'\n";
echo "   in the 'Authorization' header.\n";
