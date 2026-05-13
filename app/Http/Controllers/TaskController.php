<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\Comment;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Mail\TaskAssigned;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

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

        if ($request->hasFile('attachment')) {
            $validated['attachment_path'] = $request->file('attachment')->store('attachments', 'public');
        }

        $task = $project->tasks()->create($validated);

        if ($task->assigned_to_id) {
            $assignee = User::find($task->assigned_to_id);
            if ($assignee) {
                Mail::to($assignee->email)->send(new TaskAssigned($task));
            }
        }

        return redirect()->route('projects.show', $project)->with('success', 'Task created successfully.');
    }

    public function show(Project $project, Task $task)
    {
        $task = Task::with(['project', 'assignee', 'comments.user'])->findOrFail($task->id);
        
        $this->authorize('view', $task);

        return view('tasks.show', compact('task'));
    }

    public function edit(Project $project, Task $task)
    {
        $this->authorize('update', $task);

        $users = User::all();
        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(UpdateTaskRequest $request, Project $project, Task $task)
    {
        $this->authorize('update', $task);

        $validated = $request->validated();

        $oldAssignedTo = $task->assigned_to_id;

        if ($request->hasFile('attachment')) {
            if ($task->attachment_path) {
                Storage::disk('public')->delete($task->attachment_path);
            }
            $validated['attachment_path'] = $request->file('attachment')->store('attachments', 'public');
        }

        $task->update($validated);

        if ($task->assigned_to_id && $task->assigned_to_id !== $oldAssignedTo) {
            $assignee = User::find($task->assigned_to_id);
            if ($assignee) {
                Mail::to($assignee->email)->send(new TaskAssigned($task));
            }
        }

        return redirect()->route('tasks.show', [$project, $task])->with('success', 'Task updated successfully.');
    }

    public function destroy(Project $project, Task $task)
    {
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

        $validated['user_id'] = auth()->id();

        Comment::create($validated);

        return back()->with('success', 'Comment added successfully.');
    }
}
