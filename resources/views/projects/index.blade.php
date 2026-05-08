<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Projects') }}
            </h2>
            <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('New Project') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(isset($projects) && $projects->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($projects as $project)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col h-full">
                            <div class="p-6 flex-grow">
                                <h3 class="text-lg font-bold mb-2">
                                    <a href="{{ route('projects.show', $project) }}" class="text-indigo-600 hover:text-indigo-900 transition-colors">
                                        {{ $project->name }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                    {{ $project->description ?: 'No description provided.' }}
                                </p>
                                <div class="flex justify-between items-center mt-auto">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $project->status === 'active' ? 'bg-green-100 text-green-800' : ($project->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                        {{ ucfirst($project->status) }}
                                    </span>
                                    <span class="text-gray-500 text-xs">
                                        {{ $project->tasks->count() }} {{ Str::plural('task', $project->tasks->count()) }}
                                    </span>
                                </div>
                            </div>
                            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end space-x-2">
                                <a href="{{ route('projects.show', $project) }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">{{ __('View') }}</a>
                                <a href="{{ route('projects.edit', $project) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-900">{{ __('Edit') }}</a>
                                <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 text-center">
                        {{ __("No projects found.") }} 
                        <a href="{{ route('projects.create') }}" class="text-indigo-600 hover:underline">{{ __('Create one now!') }}</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
