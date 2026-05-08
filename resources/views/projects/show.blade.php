@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h1 class="h3 mb-0">{{ $project->name }}</h1>
                            <span class="badge bg-{{ $project->status === 'active' ? 'success' : ($project->status === 'completed' ? 'primary' : 'secondary') }}">
                                {{ ucfirst($project->status) }}
                            </span>
                        </div>
                        <p class="text-muted">{{ $project->description }}</p>
                        <hr>
                        <div class="d-grid gap-2">
                            <a href="{{ route('projects.edit', $project) }}" class="btn btn-outline-primary">Edit Project</a>
                            <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100">Delete Project</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Team Members</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @if(isset($project->members) && $project->members->count() > 0)
                                @foreach($project->members as $member)
                                    <li class="list-group-item d-flex align-items-center">
                                        <div class="avatar me-2">{{ substr($member->name, 0, 1) }}</div>
                                        {{ $member->name }}
                                    </li>
                                @endforeach
                            @else
                                <li class="list-group-item text-muted">No members assigned.</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h4 mb-0">Tasks</h2>
                    <a href="{{ route('projects.tasks.create', $project) }}" class="btn btn-primary btn-sm">Add Task</a>
                </div>

                @if(isset($project->tasks) && $project->tasks->count() > 0)
                    <div class="list-group shadow-sm">
                        @foreach($project->tasks as $task)
                            <a href="{{ route('tasks.show', $task) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <h5 class="mb-1">{{ $task->title }}</h5>
                                    <span class="badge rounded-pill bg-{{ $task->status === 'completed' ? 'success' : ($task->status === 'in_progress' ? 'primary' : 'warning text-dark') }}">
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </span>
                                </div>
                                <p class="mb-1 text-muted small">{{ Str::limit($task->description, 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <small class="text-muted">Due: {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No due date' }}</small>
                                    @if($task->assignee)
                                        <small class="text-muted">Assigned to: {{ $task->assignee->name }}</small>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="card shadow-sm">
                        <div class="card-body text-center py-5">
                            <p class="text-muted mb-0">No tasks found for this project.</p>
                            <a href="{{ route('projects.tasks.create', $project) }}" class="btn btn-link">Create your first task</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .avatar {
            width: 32px;
            height: 32px;
            background-color: #e9ecef;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.8rem;
        }
    </style>
@endsection