<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Facility;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // List all services
    public function index()
    {
        $services = Service::with('facility')->paginate(10);
        return view('services.index', compact('services'));
    }

    // Show form to create a new service
    public function create()
    {
        $facilities = Facility::orderBy('Name')->get();
        $action = route('projects.store');
        $update = false;
        return view('services.create', compact('facilities', 'action', 'update'));
    }

    // Store a new service
    public function store(Request $request)
    {
        $validated = $request->validate([
            'facility_id' => 'required|exists:facilities,id',
            'Name' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Category' => 'nullable|string|max:255',
            'SkillType' => 'nullable|string|max:255',
        ]);

        Service::create($validated);

        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }

    // Show a single service (Laravel auto-resolves Service by ServiceId)
    public function show(Service $service)
    {
        if (request()->wantsJson()) {
            return response()->json($service);
        }
        return view('services.show', compact('service'));
    }

    // Edit form
    public function edit(Service $service)
    {
        $facilities = Facility::all();
        return view('services.edit', compact('service', 'facilities'));
    }

    // Update service
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'facility_id' => 'required|exists:facilities,id',
            'Name' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Category' => 'nullable|string|max:255',
            'SkillType' => 'nullable|string|max:255',
        ]);

        $service->update($validated);

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    // Delete service
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}
