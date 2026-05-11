<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $projects = Project::with('user', 'tasks')->get();
        return ProjectResource::collection($projects);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,completed,on_hold',
        ]);

        $validated['user_id'] = auth()->id();
        $project = Project::create($validated);

        return new ProjectResource($project->load('user', 'tasks'));
    }

    public function show(Project $project)
    {
        return new ProjectResource($project->load('user', 'tasks'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,completed,on_hold',
        ]);

        $project->update($validated);
        return new ProjectResource($project->load('user', 'tasks'));
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(['message' => 'Project deleted successfully']);
    }
}
