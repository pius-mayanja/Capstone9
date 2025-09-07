<?php

namespace App\Http\Controllers;

use App\Models\Outcome;
use App\Models\Project;
use Illuminate\Http\Request;

class OutcomeController extends Controller
{
    public function index()
    {
        $outcomes = Outcome::with('project')->paginate(10);
        return view('outcomes.index', compact('outcomes'));
    }

    public function create()
    {
        // We need projects to associate outcome with one
        $projects = Project::all();
        return view('outcomes.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'artifact_link' => 'nullable|string',
            'outcome_type' => 'required|in:cad,pcb,prototype,report,business_plan',
            'quality_certification' => 'nullable|string',
            'commercialization_status' => 'required|in:demoed,market_linked,launched',
        ]);

        Outcome::create($data);
        return redirect()->route('outcomes.index')->with('success', 'Outcome created successfully.');
    }

    public function show(Outcome $outcome)
    {
        return view('outcomes.show', compact('outcome'));
    }

    public function edit(Outcome $outcome)
    {
        $projects = Project::all();
        return view('outcomes.edit', compact('outcome', 'projects'));
    }

    public function update(Request $request, Outcome $outcome)
    {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'artifact_link' => 'nullable|string',
            'outcome_type' => 'required|in:cad,pcb,prototype,report,business_plan',
            'quality_certification' => 'nullable|string',
            'commercialization_status' => 'required|in:demoed,market_linked,launched',
        ]);

        $outcome->update($data);
        return redirect()->route('outcomes.index')->with('success', 'Outcome updated successfully.');
    }

    public function destroy(Outcome $outcome)
    {
        $outcome->delete();
        return redirect()->route('outcomes.index')->with('success', 'Outcome deleted successfully.');
    }
}
