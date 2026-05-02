@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h1 class="h3 mb-0">Project Detail</h1>
                            <span class="badge bg-success">Active</span>
                        </div>
                        <p class="text-muted">This is a placeholder for the project description on the detail page.</p>
                        <hr>
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-outline-primary">Edit Project</a>
                            <button class="btn btn-outline-danger w-100">Delete Project</button>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Team Members</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center">
                                <div class="avatar me-2">A</div>
                                abishek
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <div class="avatar me-2">J</div>
                                Jane Smith
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h4 mb-0">Tasks</h2>
                    <a href="#" class="btn btn-primary btn-sm">Add Task</a>
                </div>

                <div class="list-group shadow-sm">
                    {{-- Placeholder Task 1 --}}
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between align-items-center">
                            <h5 class="mb-1">Sample Task</h5>
                            <span class="badge rounded-pill bg-primary">In Progress</span>
                        </div>
                        <p class="mb-1 text-muted small">Task description placeholder for the layout.</p>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <small class="text-muted">Due: May 15, 2026</small>
                            <small class="text-muted">Assigned to: abishek</small>
                        </div>
                    </a>
                </div>
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