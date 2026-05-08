@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 border-b border-gray-200">
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900">
                            {{ __('Create New Task') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Project') }}: {{ $project->name }}
                        </p>
                    </div>

                    <form action="{{ route('projects.tasks.store', $project) }}" method="POST">
                        @csrf
                        
                        <!-- Task Title -->
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Task Title') }}
                            </label>
                            <input type="text" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('title') border-red-500 @enderror" 
                                   placeholder="e.g. Design Homepage">
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Description') }}
                            </label>
                            <textarea id="description" 
                                      name="description" 
                                      rows="4" 
                                      class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-500 @enderror" 
                                      placeholder="What needs to be done?">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('Status') }}
                                </label>
                                <select id="status" 
                                        name="status" 
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('status') border-red-500 @enderror">
                                    <option value="todo" {{ old('status') === 'todo' ? 'selected' : '' }}>{{ __('To Do') }}</option>
                                    <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>{{ __('In Progress') }}</option>
                                    <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                                </select>
                                @error('status')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Due Date -->
                            <div>
                                <label for="due_date" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('Due Date') }}
                                </label>
                                <input type="date" 
                                       id="due_date" 
                                       name="due_date" 
                                       value="{{ old('due_date') }}" 
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('due_date') border-red-500 @enderror">
                                @error('due_date')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Assignee -->
                        <div class="mb-8">
                            <label for="assigned_to_id" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Assign To') }}
                            </label>
                            <select id="assigned_to_id" 
                                    name="assigned_to_id" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('assigned_to_id') border-red-500 @enderror">
                                <option value="">{{ __('Select User') }}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('assigned_to_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('assigned_to_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('projects.show', $project) }}" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                                {{ __('Create Task') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection