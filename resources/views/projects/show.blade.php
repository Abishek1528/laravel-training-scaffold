@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumbs & Navigation -->
            <div class="flex items-center justify-between mb-8">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm text-gray-500">
                        <li class="inline-flex items-center">
                            <a href="{{ route('projects.index') }}" class="hover:text-indigo-600 inline-flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                                {{ __('Projects') }}
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="ml-1 md:ml-2 font-medium text-gray-700">{{ $project->name }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <div class="flex space-x-3">
                    <a href="{{ route('projects.edit', $project) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('Edit Project') }}
                    </a>
                </div>
            </div>

            <!-- Project Info Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-8 border-b border-gray-200">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $project->name }}</h1>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $project->status === 'active' ? 'bg-green-100 text-green-800' : ($project->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ ucfirst($project->status) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="max-w-3xl">
                        <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">{{ __('Description') }}</h4>
                        <p class="text-gray-700 leading-relaxed mb-8">
                            {{ $project->description ?? __('No description provided.') }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pt-8 border-t border-gray-100">
                        <div>
                            <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">{{ __('Created At') }}</h4>
                            <p class="text-gray-900">{{ $project->created_at->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">{{ __('Team Members') }}</h4>
                            <p class="text-gray-900">{{ $project->members->count() + 1 }} {{ __('People') }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">{{ __('Progress') }}</h4>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                                @php
                                    $totalTasks = $project->tasks->count();
                                    $completedTasks = $project->tasks->where('status', 'completed')->count();
                                    $percentage = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;
                                @endphp
                                <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">{{ round($percentage) }}% {{ __('completed') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tasks Section -->
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-900">{{ __('Tasks') }}</h3>
                <a href="{{ route('projects.tasks.create', $project) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    {{ __('Add Task') }}
                </a>
            </div>

            @if($project->tasks->count() > 0)
                <div class="bg-white shadow overflow-hidden sm:rounded-md">
                    <ul role="list" class="divide-y divide-gray-200">
                        @foreach($project->tasks as $task)
                            <li>
                                <a href="{{ route('tasks.show', $task) }}" class="block hover:bg-gray-50 transition-colors">
                                    <div class="px-6 py-4 flex items-center">
                                        <div class="min-w-0 flex-1 flex items-center">
                                            <div class="flex-shrink-0">
                                                <span class="inline-flex items-center justify-center h-10 w-10 rounded-full {{ $task->status === 'completed' ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-500' }}">
                                                    @if($task->status === 'completed')
                                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                                    @else
                                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                                <div>
                                                    <p class="text-sm font-medium text-indigo-600 truncate">{{ $task->title }}</p>
                                                    <p class="mt-1 flex items-center text-xs text-gray-500">
                                                        <span class="truncate">{{ Str::limit($task->description, 60) }}</span>
                                                    </p>
                                                </div>
                                                <div class="hidden md:block">
                                                    <div class="flex items-center text-sm text-gray-500">
                                                        <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                        <span>{{ __('Due on') }} <time datetime="{{ $task->due_date }}">{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : __('No date') }}</time></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-12 text-center border-2 border-dashed border-gray-200">
                    <p class="text-gray-500">{{ __('No tasks found for this project.') }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection