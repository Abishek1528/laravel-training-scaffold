<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Project $project)
    {
        return view('tasks.index');
    }

    public function create(Project $project)
    {
        return view('tasks.create');
    }

    public function store(Request $request, Project $project)
    {
        abort(501, 'TODO Day 5 — implement task store');
    }

    public function show($id)
    {
        return view('tasks.show');
    }

    public function edit($id)
    {
        return view('tasks.edit');
    }

    public function update(Request $request, $id)
    {
        abort(501, 'TODO Day 5 — implement task update');
    }

    public function destroy($id)
    {
        abort(501, 'TODO Day 5 — implement task destroy');
    }
}
