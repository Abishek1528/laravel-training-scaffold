<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // Now showing all projects to everyone
        $projects = Project::with('tasks')->get();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        $project = Project::create($validated);

        // Also attach the creator as a member of the project
        $project->members()->attach(auth()->id());

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function show($id)
    {
        $project = Project::with(['tasks.comments', 'members'])->findOrFail($id);
        
        $this->authorize('view', $project);

        return view('projects.show', compact('project'));
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        
        $this->authorize('update', $project);

        return view('projects.edit', compact('project'));
    }

    public function update(UpdateProjectRequest $request, $id)
    {
        $project = Project::findOrFail($id);

        $this->authorize('update', $project);

        $validated = $request->validated();

        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        $this->authorize('delete', $project);

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
