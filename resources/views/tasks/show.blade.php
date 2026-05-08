<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Task: ') }} {{ $task->title }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('projects.tasks.edit', [$task->project, $task]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Edit Task') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <h3 class="text-lg font-bold mb-2 text-gray-700 uppercase tracking-wider text-xs">{{ __('Description') }}</h3>
                        <p class="text-gray-600">{{ $task->description ?: 'No description provided.' }}</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                        <div>
                            <h3 class="text-lg font-bold mb-2 text-gray-700 uppercase tracking-wider text-xs">{{ __('Status') }}</h3>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $task->status === 'completed' ? 'bg-green-100 text-green-800' : ($task->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold mb-2 text-gray-700 uppercase tracking-wider text-xs">{{ __('Due Date') }}</h3>
                            <p class="text-gray-600">{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No due date' }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold mb-2 text-gray-700 uppercase tracking-wider text-xs">{{ __('Assigned To') }}</h3>
                            <p class="text-gray-600">{{ $task->assignee->name ?? 'Unassigned' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">{{ __('Comments') }}</h3>
                    
                    @if($task->comments && $task->comments->count() > 0)
                        <div class="space-y-4 mb-6">
                            @foreach($task->comments as $comment)
                                <div class="border-b border-gray-100 pb-4 last:border-0">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="font-bold text-sm text-gray-800">{{ $comment->user->name }}</span>
                                        <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-700 text-sm">{{ $comment->body }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">{{ __('No comments yet.') }}</p>
                    @endif

                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="task_id" value="{{ $task->id }}">
                            <div>
                                <x-input-label for="body" :value="__('Add a comment')" />
                                <textarea id="body" name="body" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" placeholder="Write your comment here...">{{ old('body') }}</textarea>
                                <x-input-error :messages="$errors->get('body')" class="mt-2" />
                            </div>
                            <div class="mt-4 flex justify-end">
                                <x-primary-button>
                                    {{ __('Post Comment') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
