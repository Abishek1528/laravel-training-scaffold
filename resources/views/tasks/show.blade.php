@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm text-gray-500">
                    <li class="inline-flex items-center">
                        <a href="{{ route('projects.index') }}" class="hover:text-indigo-600 inline-flex items-center">
                            {{ __('Projects') }}
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="{{ route('projects.show', $task->project_id) }}" class="ml-1 md:ml-2 hover:text-indigo-600">{{ $task->project->name }}</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 md:ml-2 font-medium text-gray-700">{{ __('Task Details') }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 shadow-sm rounded-r-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Task Info -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                        <div class="p-8 border-b border-gray-200">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $task->title }}</h1>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $task->status === 'completed' ? 'bg-green-100 text-green-800' : ($task->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </span>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('tasks.edit', $task) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        {{ __('Edit') }}
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="prose max-w-none text-gray-700 mb-8">
                                <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">{{ __('Description') }}</h4>
                                <p>{{ $task->description ?? __('No description provided.') }}</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-8 border-t border-gray-100">
                                <div>
                                    <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">{{ __('Due Date') }}</h4>
                                    <p class="flex items-center text-gray-900">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : __('No due date') }}
                                    </p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">{{ __('Assigned To') }}</h4>
                                    <p class="flex items-center text-gray-900">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        {{ $task->assignee->name ?? __('Unassigned') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-6">{{ __('Comments') }}</h3>
                            
                            <div class="space-y-6 mb-8">
                                @forelse($task->comments as $comment)
                                    <div class="flex space-x-3">
                                        <div class="flex-shrink-0">
                                            <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold">
                                                {{ substr($comment->user->name, 0, 1) }}
                                            </div>
                                        </div>
                                        <div class="flex-1 bg-gray-50 rounded-lg px-4 py-3 border border-gray-100">
                                            <div class="flex items-center justify-between mb-1">
                                                <h4 class="text-sm font-bold text-gray-900">{{ $comment->user->name }}</h4>
                                                <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-sm text-gray-700">{{ $comment->body }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-center text-gray-500 py-4">{{ __('No comments yet.') }}</p>
                                @endforelse
                            </div>

                            <form action="{{ route('comments.store') }}" method="POST" class="mt-6">
                                @csrf
                                <input type="hidden" name="task_id" value="{{ $task->id }}">
                                <div>
                                    <label for="comment" class="sr-only">{{ __('Add a comment') }}</label>
                                    <textarea id="comment" name="body" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="{{ __('Write a comment...') }}">{{ old('body') }}</textarea>
                                    @error('body')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mt-3 flex justify-end">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                                        {{ __('Post Comment') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Sidebar / Meta -->
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sticky top-8">
                        <div class="p-6">
                            <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4">{{ __('Project Context') }}</h4>
                            <div class="p-4 bg-indigo-50 rounded-lg border border-indigo-100">
                                <h5 class="font-bold text-indigo-900 mb-1">{{ $task->project->name }}</h5>
                                <p class="text-xs text-indigo-700 mb-4 line-clamp-3">{{ $task->project->description }}</p>
                                <a href="{{ route('projects.show', $task->project_id) }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 flex items-center">
                                    {{ __('View Project') }}
                                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection