<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // $projects = Project::with('outcomes')->get();
        $projects = Project::with('outcomes')->paginate(10);
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'facility_id' => 'required|exists:facilities,id',
            'title' => 'required|string',
            'nature_of_project' => 'required|in:research,prototype,applied',
            'description' => 'nullable|string',
            'innovation_focus' => 'nullable|string',
            'prototype_stage' => 'required|in:concept,prototype,mvp,market_launch',
            'testing_requirements' => 'nullable|string',
            'commercialization_plan' => 'nullable|string',
        ]);

        Project::create($data);
        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $project->update($data);
        return redirect()->route('projects.index')->with('success', 'Project updated.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted.');
    }
} 
