@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('projects.show', $task->project_id) }}">{{ $task->project->name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Task Detail</li>
                    </ol>
                </nav>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-top mb-3">
                            <div>
                                <h1 class="h3 mb-1">{{ $task->title }}</h1>
                                <span class="badge rounded-pill bg-{{ $task->status === 'completed' ? 'success' : ($task->status === 'in_progress' ? 'primary' : 'warning text-dark') }}">
                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                </span>
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-outline-secondary">Edit</a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                                </form>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="text-muted small text-uppercase fw-bold">Description</h5>
                            <p>{{ $task->description ?? 'No description provided.' }}</p>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <h5 class="text-muted small text-uppercase fw-bold">Due Date</h5>
                                <p>{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No due date' }}</p>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <h5 class="text-muted small text-uppercase fw-bold">Assigned To</h5>
                                <p>{{ $task->assignee->name ?? 'Unassigned' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Comments</h5>
                    </div>
                    <div class="card-body">
                        @if($task->comments && $task->comments->count() > 0)
                            @foreach($task->comments as $comment)
                                <div class="mb-3 pb-3 border-bottom">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="fw-bold">{{ $comment->user->name }}</span>
                                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-0">{{ $comment->body }}</p>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted text-center mb-0">No comments yet.</p>
                        @endif
                        
                        <hr>
                        
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="task_id" value="{{ $task->id }}">
                            <div class="mb-3">
                                <label for="comment" class="form-label">Add a comment</label>
                                <textarea class="form-control @error('body') is-invalid @enderror" id="comment" name="body" rows="3" placeholder="Write your comment here...">{{ old('body') }}</textarea>
                                @error('body')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Post Comment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection