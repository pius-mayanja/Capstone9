<?php

namespace App\Http\Controllers;

use App\Models\Outcome;
use App\Models\Project;
use Illuminate\Http\Request;

class OutcomeController extends Controller
{
    public function index()
    {
        // Use pagination so the view can call ->total(), ->links(), etc.
        $outcomes = Outcome::with('project')->paginate(10);
        return view('outcomes.index', compact('outcomes'));
    }

    public function create()
    {
        // Provide projects for the select input
        $projects = Project::orderBy('title')->get();
        return view('outcomes.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'artifact_link' => 'nullable|string|max:500',
            'outcome_type' => 'required|in:cad,pcb,prototype,report,business_plan',
            'quality_certification' => 'nullable|string|max:255',
            'commercialization_status' => 'required|in:demoed,market_linked,launched',
        ]);

        Outcome::create($data);

        return redirect()->route('outcomes.index')->with('success', 'Outcome created successfully.');
    }

    public function show(Outcome $outcome)
    {
        $outcome->load('project');
        return view('outcomes.show', compact('outcome'));
    }

    public function edit(Outcome $outcome)
    {
        $projects = Project::orderBy('title')->get();
        return view('outcomes.edit', compact('outcome', 'projects'));
    }

    public function update(Request $request, Outcome $outcome)
    {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'artifact_link' => 'nullable|string|max:500',
            'outcome_type' => 'required|in:cad,pcb,prototype,report,business_plan',
            'quality_certification' => 'nullable|string|max:255',
            'commercialization_status' => 'required|in:demoed,market_linked,launched',
        ]);

        $outcome->update($data);

        return redirect()->route('outcomes.show', $outcome)->with('success', 'Outcome updated.');
    }

    public function destroy(Outcome $outcome)
    {
        $outcome->delete();
        return redirect()->route('outcomes.index')->with('success', 'Outcome deleted.');
    }
}
