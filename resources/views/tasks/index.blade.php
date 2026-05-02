@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="#">Projects</a></li>
                        <li class="breadcrumb-item"><a href="#">Sample Project</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tasks</li>
                    </ol>
                </nav>
                <h1 class="h2">Tasks</h1>
            </div>
            <a href="#" class="btn btn-primary">New Task</a>
        </div>

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
                        <tr>
                            <td>
                                <a href="#" class="text-decoration-none fw-bold text-dark">Sample Task</a>
                                <div class="small text-muted">Placeholder task description...</div>
                            </td>
                            <td>
                                <span class="badge rounded-pill bg-primary">In Progress</span>
                            </td>
                            <td>May 20, 2026</td>
                            <td>abishek</td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection