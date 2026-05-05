@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Projects</h1>
            <a href="{{ route('projects.create') }}" class="btn btn-primary">New Project</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(isset($projects) && $projects->count() > 0)
            <div class="row">
                @foreach($projects as $project)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('projects.show', $project) }}" class="text-decoration-none">{{ $project->name }}</a>
                                </h5>
                                <p class="card-text text-muted">{{ Str::limit($project->description, 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-{{ $project->status === 'active' ? 'success' : ($project->status === 'completed' ? 'primary' : 'secondary') }}">
                                        {{ ucfirst($project->status) }}
                                    </span>
                                    <small class="text-muted">{{ $project->tasks()->count() }} tasks</small>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-top-0 d-flex justify-content-end">
                                <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-outline-secondary me-2">Edit</a>
                                <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                No projects found. <a href="{{ route('projects.create') }}">Create one now!</a>
            </div>
        @endif
    </div>
@endsection