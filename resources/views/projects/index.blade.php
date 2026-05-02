@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Projects</h1>
            <a href="#" class="btn btn-primary">New Project</a>
        </div>

        <div class="row">
            {{-- Placeholder Card 1 --}}
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="#" class="text-decoration-none">Sample Project</a>
                        </h5>
                        <p class="card-text text-muted">This is a placeholder description for a project layout.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-success">Active</span>
                            <small class="text-muted">3 tasks</small>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top-0 d-flex justify-content-end">
                        <a href="#" class="btn btn-sm btn-outline-secondary me-2">Edit</a>
                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </div>
                </div>
            </div>
            
            {{-- Placeholder Card 2 --}}
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="#" class="text-decoration-none">Another Project</a>
                        </h5>
                        <p class="card-text text-muted">Another placeholder for the project list layout.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-secondary">Inactive</span>
                            <small class="text-muted">0 tasks</small>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top-0 d-flex justify-content-end">
                        <a href="#" class="btn btn-sm btn-outline-secondary me-2">Edit</a>
                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection