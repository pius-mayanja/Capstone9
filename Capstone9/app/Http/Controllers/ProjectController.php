<?php

// namespace App\Http\Controllers;

// use App\Models\Project;
// use App\Models\Facility;
// use App\Models\Program;
// use Illuminate\Http\Request;

// class ProjectController extends Controller
// {
//     public function index()
//     {
//         // paginate so views can call total(), links(), firstItem() etc.
//         $projects = Project::with(['facility', 'program'])->paginate(10);
//         return view('projects.index', compact('projects'));
//     }

//     public function create()
//     {
//         $facilities = \App\Models\Facility::orderBy('Name')->get();
//         $programs = \App\Models\Program::orderBy('Name')->get();

//         return view('projects.create', compact('facilities', 'programs'));
//     }

//     public function store(Request $request)
//     {
//         $data = $request->validate([
//             'title' => 'required|string',
//             'description' => 'nullable|string',
//             'facility_id' => 'required|exists:facilities,id',
//             'program_id' => 'required|exists:programs,id',
//             'prototype_stage' => 'required|in:concept,prototype,mvp,market_launch',
//         ]);
    
//         Project::create($data);
    
//         return redirect()->route('projects.index')
//             ->with('success', 'Project created successfully!');
//     }
    

//     public function show(Project $project)
//     {
//         $project->load(['outcomes', 'facility', 'program']);
//         return view('projects.show', compact('project'));
//     }

//     public function edit(Project $project)
//     {
//         $facilities = Facility::orderBy('Name')->get();
//         $programs = Program::orderBy('Name')->get();

//         return view('projects.edit', compact('project', 'facilities', 'programs'));
//     }

//     public function update(Request $request, Project $project)
//     {
//         $data = $request->validate([
//             'program_id' => 'required|exists:programs,id',
//             'facility_id' => 'required|exists:facilities,id',
//             'title' => 'required|string|max:255',
//             'nature_of_project' => 'nullable|in:research,prototype,applied',
//             'description' => 'nullable|string',
//             'innovation_focus' => 'nullable|string|max:255',
//             'prototype_stage' => 'required|in:concept,prototype,mvp,market_launch',
//             'testing_requirements' => 'nullable|string',
//             'commercialization_plan' => 'nullable|string',
//         ]);

//         $project->update($data);

//         return redirect()->route('projects.show', $project)->with('success', 'Project updated.');
//     }

//     public function destroy(Project $project)
//     {
//         $project->delete();
//         return redirect()->route('projects.index')->with('success', 'Project deleted.');
//     }
// }



namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Facility;
use App\Models\Program;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['facility', 'program'])->paginate(10);
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $facilities = Facility::orderBy('Name')->get();
        $programs = Program::orderBy('Name')->get();

        // Add $action and $update for the shared form
        $action = route('projects.store');
        $update = false;

        return view('projects.create', compact('facilities', 'programs', 'action', 'update'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'nature_of_project' => 'required|in:research,prototype,applied',
            'facility_id' => 'required|exists:facilities,id', 
            'program_id' => 'required|exists:programs,id',            
            'prototype_stage' => 'required|in:concept,prototype,mvp,market_launch',
        ]);
    
        Project::create($data);
    
        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully!');
    }
    
    public function show(Project $project)
    {
        $project->load(['outcomes', 'facility', 'program']);
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $facilities = Facility::orderBy('Name')->get();
        $programs = Program::orderBy('Name')->get();

        // Add $action and $update for the shared form
        $action = route('projects.update', $project->id);
        $update = true;

        return view('projects.edit', compact('project', 'facilities', 'programs', 'action', 'update'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'facility_id' => 'required|exists:facilities,id',
            'title' => 'required|string|max:255',
            'nature_of_project' => 'nullable|in:research,prototype,applied',
            'description' => 'nullable|string',
            'innovation_focus' => 'nullable|string|max:255',
            'prototype_stage' => 'required|in:concept,prototype,mvp,market_launch',
            'testing_requirements' => 'nullable|string',
            'commercialization_plan' => 'nullable|string',
        ]);

        $project->update($data);

        return redirect()->route('projects.show', $project)->with('success', 'Project updated.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted.');
    }
}
