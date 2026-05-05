@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tasks</li>
                    </ol>
                </nav>
                <h1 class="h2">Tasks for {{ $project->name }}</h1>
            </div>
            <a href="{{ route('projects.tasks.create', $project) }}" class="btn btn-primary">New Task</a>
        </div>

        @if(isset($tasks) && $tasks->count() > 0)
            <div class="card shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Due Date</th>
                                <th>Assigned To</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>
                                        <a href="{{ route('tasks.show', $task) }}" class="text-decoration-none fw-bold text-dark">{{ $task->title }}</a>
                                        <div class="small text-muted">{{ Str::limit($task->description, 50) }}</div>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-{{ $task->status === 'completed' ? 'success' : ($task->status === 'in_progress' ? 'primary' : 'warning text-dark') }}">
                                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                        </span>
                                    </td>
                                    <td>{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : '-' }}</td>
                                    <td>{{ $task->assignee->name ?? '-' }}</td>
                                    <td class="text-end">
                                        <div class="btn-group">
                                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-info">
                No tasks found for this project. <a href="{{ route('projects.tasks.create', $project) }}">Create one now!</a>
            </div>
        @endif
    </div>
@endsection