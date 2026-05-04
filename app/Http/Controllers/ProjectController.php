<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects.index');
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        abort(501, 'TODO Day 5 — implement store');
    }

    public function show($id)
    {
        return view('projects.show');
    }

    public function edit($id)
    {
        return view('projects.edit');
    }

    public function update(Request $request, $id)
    {
        abort(501, 'TODO Day 5 — implement update');
    }

    public function destroy($id)
    {
        abort(501, 'TODO Day 5 — implement destroy');
    }
}
