<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Facility;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Equipment::query()->with('facility');

        // Search
        if ($search = $request->input('search')) {
            $query->where('Capability', 'like', "%$search%")
                  ->orWhere('Domain', 'like', "%$search%")
                  ->orWhere('Name', 'like', "%$search%");
        }

        $equipment = $query->paginate(10);
        return view('equipment.index', compact('equipment'));
    }

    public function create()
    {
        $facilities = Facility::all();
        return view('equipment.create', compact('facilities'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Name' => 'required|string|max:255',
            'Type' => 'required|string|max:255',
            'Capability' => 'required|string|max:255',
            'Domain' => 'nullable|string|max:255',
            'Description' => 'nullable|string',
            'FacilityId' => 'nullable|exists:facilities,FacilityId',
        ]);

        Equipment::create($data);
        return redirect()->route('equipment.index')->with('success', 'Equipment created successfully!');
    }

    public function show(Equipment $equipment)
    {
        return view('equipment.show', compact('equipment'));
    }

    public function edit(Equipment $equipment)
    {
        $facilities = Facility::all();
        return view('equipment.edit', compact('equipment', 'facilities'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        $data = $request->validate([
            'Name' => 'required|string|max:255',
            'Type' => 'required|string|max:255',
            'Capability' => 'required|string|max:255',
            'Domain' => 'nullable|string|max:255',
            'Description' => 'nullable|string',
            'FacilityId' => 'nullable|exists:facilities,FacilityId',
        ]);

        $equipment->update($data);
        return redirect()->route('equipment.index')->with('success', 'Equipment updated successfully!');
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();
        return redirect()->route('equipment.index')->with('success', 'Equipment deleted successfully!');
    }
}

