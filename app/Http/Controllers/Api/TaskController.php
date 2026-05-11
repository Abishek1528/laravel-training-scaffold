<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Project $project)
    {
        $tasks = $project->tasks()->with('assignee', 'comments')->get();
        return TaskResource::collection($tasks);
    }

    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in_progress,completed',
            'due_date' => 'nullable|date',
            'assigned_to_id' => 'nullable|exists:users,id',
        ]);

        $validated['project_id'] = $project->id;
        $task = Task::create($validated);

        return new TaskResource($task->load('assignee', 'comments'));
    }

    public function show(Project $project, Task $task)
    {
        return new TaskResource($task->load('assignee', 'comments'));
    }

    public function update(Request $request, Project $project, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in_progress,completed',
            'due_date' => 'nullable|date',
            'assigned_to_id' => 'nullable|exists:users,id',
        ]);

        $task->update($validated);
        return new TaskResource($task->load('assignee', 'comments'));
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
