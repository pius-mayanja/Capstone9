<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Facility;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::with('facility')->paginate(10);
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $facilities = Facility::all();
        return view('services.create', compact('facilities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $data = $request->validate([
            'FacilityId' => 'required|exists:facilities,FacilityId',
            'Name' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Category' => 'required|string|max:100',
            'SkillType' => 'required|string|max:100',
        ]);

        Service::create($data);

        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $facilities = Facility::all();
        return view('services.edit', compact('service','facilities'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'FacilityId' => 'required|exists:facilities,FacilityId',
            'Name' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Category' => 'required|string|max:100',
            'SkillType' => 'required|string|max:100',
        ]);

        $service->update($data);

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success','Service deleted successfully.');
    }
}
