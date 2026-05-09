<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('projects.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            Projects
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <a href="{{ route('projects.show', $task->project_id) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">{{ $task->project->name }}</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Task Detail</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <div class="flex space-x-2">
                @can('update', $task)
                    <a href="{{ route('tasks.edit', $task) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Edit
                    </a>
                @endcan
                @can('delete', $task)
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Delete
                        </button>
                    </form>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h1 class="text-2xl font-bold mb-2">{{ $task->title }}</h1>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-{{ $task->status === 'completed' ? 'green' : ($task->status === 'in_progress' ? 'blue' : 'yellow') }}-100 text-{{ $task->status === 'completed' ? 'green' : ($task->status === 'in_progress' ? 'blue' : 'yellow') }}-800">
                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h5 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Description</h5>
                        <p class="text-gray-700">{{ $task->description ?? 'No description provided.' }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h5 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Due Date</h5>
                            <p class="text-gray-700">{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No due date' }}</p>
                        </div>
                        <div>
                            <h5 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Assigned To</h5>
                            <p class="text-gray-700">{{ $task->assignee->name ?? 'Unassigned' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-6">Comments</h3>
                    
                    <div class="space-y-6 mb-8">
                        @if($task->comments && $task->comments->count() > 0)
                            @foreach($task->comments as $comment)
                                <div class="border-b pb-4">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="font-bold text-sm text-gray-800">{{ $comment->user->name }}</span>
                                        <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-700 text-sm">{{ $comment->body }}</p>
                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-500 text-center py-4">No comments yet.</p>
                        @endif
                    </div>
                    
                    <form action="{{ route('comments.store') }}" method="POST" class="mt-6">
                        @csrf
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <div class="mb-4">
                            <x-input-label for="comment" :value="__('Add a comment')" />
                            <textarea id="comment" name="body" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" placeholder="Write your comment here...">{{ old('body') }}</textarea>
                            <x-input-error :messages="$errors->get('body')" class="mt-2" />
                        </div>
                        <x-primary-button>
                            {{ __('Post Comment') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>