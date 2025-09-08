<?php

namespace App\Http\Controllers;

use App\Models\Participants;
use App\Models\Project;
use Illuminate\Http\Request;

class ParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $participants = Participants::with('projects')->paginate(10);
        return view('participants.index', compact('participants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();
        return view('participants.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'FullName' => 'required|string|max:255',
            'Email' => 'required|email|unique:participants,Email',
            'Affiliation' => 'required|string|max:255',
            'Specialization' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'CrossSkillTrained' => 'boolean',
            'Institution' => 'required|string|max:255',
            'project_ids' => 'array'
        ]);

        $participant = Participants::create($data);

        if (!empty($data['project_ids'])) {
            $participant->projects()->attach($data['project_ids']);
        }

        return redirect()->route('participants.index')->with('success', 'Participant added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Participants $participant)
    {
        $participant = Participants::with('projects')->findOrFail($participant->ParticipantId);
        return view('participants.show', compact('participant'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Participants $participant)
    {
        $projects = Project::all();
        return view('participants.edit', compact('participant', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Participants $participant)
    {
        $data = $request->validate([
            'FullName' => 'required|string|max:255',
            'Email' => 'required|email|unique:participants,Email,' . $participant->ParticipantId,
            'Affiliation' => 'required|string|max:255',
            'Specialization' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'CrossSkillTrained' => 'boolean',
            'Institution' => 'required|string|max:255',
            'project_ids' => 'array'
        ]);

        $participant->update($data);

        if (!empty($data['project_ids'])) {
            $participant->projects()->sync($data['project_ids']);
        }

        return redirect()->route('participants.index')->with('success', 'Participant updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $participant = Participants::findOrFail($id);
        $participant->delete();

        return redirect()->route('participants.index')->with('success', 'Participant deleted successfully!');
    }
}
