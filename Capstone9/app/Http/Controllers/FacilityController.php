<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;


class FacilityController extends Controller
{
    public function index(Request $request)
    {
        // search & filter
        $query = Facility::query();

        if ($request->filled('type')) {
            $query->where('FacilityType', $request->type);
        }
        if ($request->filled('partner')) {
            $query->where('PartnerOrganization', 'like', "%{$request->partner}%");
        }
        if ($request->filled('capability')) {
            $query->whereJsonContains('Capabilities', $request->capability);
        }

        $facilities = $query->paginate(10);

        return view('facilities.index', compact('facilities'));
    }

    public function create()
    {
        return view('facilities.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Name' => 'required|string|max:255',
            'Location' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'PartnerOrganization' => 'nullable|string|max:255',
            'FacilityType' => 'required|string',
            'Capabilities' => 'nullable|string'
        ]);

        // convert CSV capabilities into array
        $data['Capabilities'] = array_map('trim', explode(',', $data['Capabilities'] ?? ''));

        Facility::create($data);
        return redirect()->route('facilities.index')->with('success', 'Facility added successfully!');
    }

    public function show(Facility $facility)
    {
        return view('facilities.show', compact('facility'));
    }

    public function edit(Facility $facility)
    {
        return view('facilities.edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $data = $request->validate([
            'Name' => 'required|string|max:255',
            'Location' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'PartnerOrganization' => 'nullable|string|max:255',
            'FacilityType' => 'required|string',
            'Capabilities' => 'nullable|string'
        ]);

        $data['Capabilities'] = array_map('trim', explode(',', $data['Capabilities'] ?? ''));

        $facility->update($data);
        return redirect()->route('facilities.index')->with('success', 'Facility updated!');
    }

    public function destroy(Facility $facility)
    {
        $facility->delete();
        return redirect()->route('facilities.index')->with('success', 'Facility deleted!');
    }
}
