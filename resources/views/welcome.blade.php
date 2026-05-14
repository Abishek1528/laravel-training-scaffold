<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gradient-to-br from-orange-50 via-orange-100 to-amber-50">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <a href="/" class="flex items-center space-x-2">
                            <span class="text-xl font-bold bg-gradient-to-r from-orange-600 to-amber-600 bg-clip-text text-transparent">WorkSync</span>
                        </a>
                    </div>
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-orange-600 transition-colors font-medium">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-700 hover:text-orange-600 transition-colors font-medium">Login</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-orange-500 to-amber-500 text-white px-5 py-2.5 rounded-lg font-medium hover:from-orange-600 hover:to-amber-600 transition-all shadow-lg hover:shadow-orange-500/30 transform hover:-translate-y-0.5">Register</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="pt-16 pb-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="space-y-8">
                        <div class="inline-flex items-center px-4 py-2 bg-orange-100 rounded-full">
                            <span class="w-2 h-2 bg-orange-500 rounded-full mr-2 animate-pulse"></span>
                            <span class="text-orange-700 font-medium text-sm">Boost your productivity</span>
                        </div>
                        <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                            Manage your <span class="bg-gradient-to-r from-orange-500 to-amber-500 bg-clip-text text-transparent">tasks</span> with ease
                        </h1>
                        <p class="text-lg text-gray-600 leading-relaxed">
                            Streamline your workflow, collaborate with your team, and achieve your goals faster with our powerful task management platform.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            @if (Route::has('register'))
                                @guest
                                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-orange-500 to-amber-500 text-white font-semibold rounded-xl hover:from-orange-600 hover:to-amber-600 transition-all shadow-xl hover:shadow-orange-500/40 transform hover:-translate-y-1">
                                        Get Started
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white text-gray-700 font-semibold rounded-xl border-2 border-gray-200 hover:border-orange-300 hover:text-orange-600 transition-all">
                                        Sign In
                                    </a>
                                @endguest
                            @endif
                        </div>
                    </div>
                    <div class="relative">
                        <div class="absolute -top-10 -left-10 w-72 h-72 bg-orange-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
                        <div class="absolute -bottom-10 -right-10 w-72 h-72 bg-amber-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse" style="animation-delay: 2s;"></div>
                        <div class="relative bg-white rounded-3xl shadow-2xl p-8 transform rotate-2 hover:rotate-0 transition-transform duration-500">
                            <div class="flex items-center space-x-4 mb-6">
                                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900">Active Tasks</h3>
                                    <p class="text-sm text-gray-500">Today's progress</p>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center p-4 bg-orange-50 rounded-xl">
                                    <div class="w-3 h-3 bg-orange-500 rounded-full mr-4"></div>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-900">Bug the code</p>
                                        <p class="text-sm text-gray-500">Due today</p>
                                    </div>
                                </div>
                                <div class="flex items-center p-4 bg-amber-50 rounded-xl">
                                    <div class="w-3 h-3 bg-amber-500 rounded-full mr-4"></div>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-900">Testing and debugging</p>
                                        <p class="text-sm text-gray-500">In progress</p>
                                    </div>
                                </div>
                                <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                    <div class="w-3 h-3 bg-gray-400 rounded-full mr-4"></div>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-900">Documentation update</p>
                                        <p class="text-sm text-gray-500">Pending</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features Section -->
                <div class="mt-32">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Powerful Features</h2>
                        <p class="text-lg text-gray-600 max-w-2xl mx-auto">Everything you need to manage your projects efficiently</p>
                    </div>
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-2">
                            <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center mb-6">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Task Management</h3>
                            <p class="text-gray-600">Create, assign, and track tasks with ease. Set priorities and deadlines.</p>
                        </div>
                        <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-2">
                            <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center mb-6">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Team Collaboration</h3>
                            <p class="text-gray-600">Work together with your team. Assign tasks and leave comments.</p>
                        </div>
                        <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-2">
                            <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-amber-500 rounded-xl flex items-center justify-center mb-6">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Progress Tracking</h3>
                            <p class="text-gray-600">Monitor your project progress with detailed statistics and reports.</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-400">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="flex items-center space-x-2 mb-4 md:mb-0">
                        <span class="text-xl font-bold text-white">WorkSync</span>
                    </div>
                    <p class="text-sm">© 2026 WorkSync. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
