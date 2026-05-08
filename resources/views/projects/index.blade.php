<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Projects') }}
            </h2>
            <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                New Project
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if(isset($projects) && $projects->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($projects as $project)
                            <div class="border rounded-lg shadow-sm flex flex-col">
                                <div class="p-4 flex-grow">
                                    <h5 class="text-lg font-bold mb-2">
                                        <a href="{{ route('projects.show', $project) }}" class="text-blue-600 hover:text-blue-800">{{ $project->name }}</a>
                                    </h5>
                                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($project->description, 100) }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $project->status === 'active' ? 'bg-green-100 text-green-800' : ($project->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ ucfirst($project->status) }}
                                        </span>
                                        <small class="text-gray-500">{{ $project->tasks->count() }} tasks</small>
                                    </div>
                                </div>
                                <div class="p-4 bg-gray-50 border-t flex justify-end space-x-2">
                                    <a href="{{ route('projects.show', $project) }}" class="text-sm text-blue-600 hover:text-blue-800">View</a>
                                    <a href="{{ route('projects.edit', $project) }}" class="text-sm text-gray-600 hover:text-gray-800">Edit</a>
                                    <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-red-600 hover:text-red-800">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">No projects found. <a href="{{ route('projects.create') }}" class="underline font-bold">Create one now!</a></span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>