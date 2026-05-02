@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Projects</a></li>
                        <li class="breadcrumb-item"><a href="#">Sample Project</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Task Detail</li>
                    </ol>
                </nav>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-top mb-3">
                            <div>
                                <h1 class="h3 mb-1">Task Detail</h1>
                                <span class="badge rounded-pill bg-primary">In Progress</span>
                            </div>
                            <div class="btn-group">
                                <a href="#" class="btn btn-outline-secondary">Edit</a>
                                <button class="btn btn-outline-danger">Delete</button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="text-muted small text-uppercase fw-bold">Description</h5>
                            <p>This is a placeholder for the task description on the detail page.</p>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <h5 class="text-muted small text-uppercase fw-bold">Due Date</h5>
                                <p>May 20, 2026</p>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <h5 class="text-muted small text-uppercase fw-bold">Assigned To</h5>
                                <p>abishek</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Comments</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 pb-3 border-bottom">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-bold">Jane Smith</span>
                                <small class="text-muted">2 hours ago</small>
                            </div>
                            <p class="mb-0">This is a placeholder comment.</p>
                        </div>
                        
                        <hr>
                        
                        <form action="#" method="POST">
                            <div class="mb-3">
                                <label for="comment" class="form-label">Add a comment</label>
                                <textarea class="form-control" id="comment" name="content" rows="3" placeholder="Write your comment here..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Post Comment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection