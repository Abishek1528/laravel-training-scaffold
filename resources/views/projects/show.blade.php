<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Project: ') }} {{ $project->name }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('projects.edit', $project) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Edit Project') }}
                </a>
                <a href="{{ route('projects.tasks.create', $project) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Add Task') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <h3 class="text-lg font-bold mb-2 text-gray-700 uppercase tracking-wider text-xs">{{ __('Description') }}</h3>
                        <p class="text-gray-600">{{ $project->description ?: 'No description provided.' }}</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                        <div>
                            <h3 class="text-lg font-bold mb-2 text-gray-700 uppercase tracking-wider text-xs">{{ __('Status') }}</h3>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $project->status === 'active' ? 'bg-green-100 text-green-800' : ($project->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ ucfirst($project->status) }}
                            </span>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold mb-2 text-gray-700 uppercase tracking-wider text-xs">{{ __('Owner') }}</h3>
                            <p class="text-gray-600">{{ $project->owner->name }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="text-xl font-bold mb-4 text-gray-800">{{ __('Tasks') }}</h3>
            @if($project->tasks->count() > 0)
                <div class="grid grid-cols-1 gap-4">
                    @foreach($project->tasks as $task)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 flex justify-between items-center">
                                <div>
                                    <h4 class="text-lg font-bold mb-1">
                                        <a href="{{ route('projects.tasks.show', [$project, $task]) }}" class="text-indigo-600 hover:underline">
                                            {{ $task->title }}
                                        </a>
                                    </h4>
                                    <p class="text-gray-600 text-sm line-clamp-1">{{ $task->description }}</p>
                                    <div class="mt-2 flex space-x-4">
                                        <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $task->status === 'completed' ? 'bg-green-100 text-green-800' : ($task->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                        </span>
                                        @if($task->due_date)
                                            <span class="text-xs text-gray-500">
                                                {{ __('Due: ') }} {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                            </span>
                                        @endif
                                        <span class="text-xs text-gray-500">
                                            {{ __('Assigned to: ') }} {{ $task->assignee->name ?? 'Unassigned' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="text-sm text-indigo-600 hover:text-indigo-900">{{ __('Edit') }}</a>
                                    <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 text-center">
                        {{ __("No tasks found for this project.") }}
                        <a href="{{ route('projects.tasks.create', $project) }}" class="text-indigo-600 hover:underline">{{ __('Add one now!') }}</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
