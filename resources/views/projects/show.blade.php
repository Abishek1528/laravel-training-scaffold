<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $project->name }}
            </h2>
            <div class="flex space-x-2">
                @can('update', $project)
                    <a href="{{ route('projects.edit', $project) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        Edit Project
                    </a>
                @endcan
                @can('delete', $project)
                    <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Delete Project
                        </button>
                    </form>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Sidebar: Project Info & Members -->
                <div class="space-y-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold">Project Details</h3>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $project->status === 'active' ? 'bg-green-100 text-green-800' : ($project->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ ucfirst($project->status) }}
                            </span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">{{ $project->description }}</p>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold mb-4">Team Members</h3>
                        <div class="space-y-3">
                            @if(isset($project->members) && $project->members->count() > 0)
                                @foreach($project->members as $member)
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center font-bold text-xs text-gray-600">
                                            {{ substr($member->name, 0, 1) }}
                                        </div>
                                        <span class="text-sm text-gray-700">{{ $member->name }}</span>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-sm text-gray-500">No members assigned.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Main Content: Tasks -->
                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-gray-800">Tasks</h3>
                            <a href="{{ route('projects.tasks.create', $project) }}" class="inline-flex items-center px-3 py-1 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Add Task
                            </a>
                        </div>

                        @if(isset($project->tasks) && $project->tasks->count() > 0)
                            <div class="space-y-4">
                                @foreach($project->tasks as $task)
                                    <div class="block p-4 border rounded-lg hover:bg-gray-50 transition duration-150">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <a href="{{ route('tasks.show', [$project, $task]) }}" class="font-bold text-blue-600 hover:text-blue-800">{{ $task->title }}</a>
                                                <span class="ml-2 px-2 py-1 text-xs font-semibold rounded-full bg-{{ $task->status === 'completed' ? 'green' : ($task->status === 'in_progress' ? 'blue' : 'yellow') }}-100 text-{{ $task->status === 'completed' ? 'green' : ($task->status === 'in_progress' ? 'blue' : 'yellow') }}-800">
                                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                                </span>
                                            </div>
                                            <div class="flex space-x-2">
                                                @can('update', $task)
                                                    <a href="{{ route('tasks.edit', [$project, $task]) }}" class="text-sm text-blue-600 hover:text-blue-800">Edit</a>
                                                @endcan
                                                @can('delete', $task)
                                                    <form action="{{ route('tasks.destroy', [$project, $task]) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-sm text-red-600 hover:text-red-800">Delete</button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </div>
                                        <p class="text-sm text-gray-600 mb-3">{{ Str::limit($task->description, 100) }}</p>
                                        <div class="flex justify-between items-center text-xs text-gray-500">
                                            <span>Due: {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No due date' }}</span>
                                            @if($task->assignee)
                                                <span>Assigned: {{ $task->assignee->name }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <p class="text-gray-500 mb-4">No tasks found for this project.</p>
                                <a href="{{ route('projects.tasks.create', $project) }}" class="text-indigo-600 hover:text-indigo-900 font-bold">Create your first task</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>