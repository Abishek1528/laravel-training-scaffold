<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\Comment;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Project $project)
    {
        // Day 6 TODO: eager load tasks.comments, tasks.assignee
        $tasks = $project->tasks; 
        return view('tasks.index', compact('project', 'tasks'));
    }

    public function create(Project $project)
    {
        $users = User::all();
        return view('tasks.create', compact('project', 'users'));
    }

    public function store(StoreTaskRequest $request, Project $project)
    {
        $validated = $request->validated();

        $project->tasks()->create($validated);

        return redirect()->route('projects.show', $project)->with('success', 'Task created successfully.');
    }

    public function show($id)
    {
        $task = Task::with(['project', 'assignee', 'comments.user'])->findOrFail($id);
        
        $this->authorize('view', $task);

        return view('tasks.show', compact('task'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        
        $this->authorize('update', $task);

        $users = User::all();
        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);

        $this->authorize('update', $task);

        $validated = $request->validated();

        $task->update($validated);

        return redirect()->route('projects.show', $task->project_id)->with('success', 'Task updated successfully.');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        
        $this->authorize('delete', $task);

        $projectId = $task->project_id;
        $task->delete();

        return redirect()->route('projects.show', $projectId)->with('success', 'Task deleted successfully.');
    }

    public function storeComment(Request $request)
    {
        $validated = $request->validate([
            'body' => 'required|string',
            'task_id' => 'required|exists:tasks,id',
        ]);

        $validated['user_id'] = User::first()->id ?? 1;

        Comment::create($validated);

        return back()->with('success', 'Comment added successfully.');
    }
}
