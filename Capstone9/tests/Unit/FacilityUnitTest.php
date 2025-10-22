<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use App\Models\Facility;
use App\Models\Service;
use App\Models\Equipment;
use App\Models\Project;
use App\Models\Program;

class FacilityUnitTest extends TestCase
{
    use RefreshDatabase;

    /** Required Fields */
    public function test_required_fields_rule_for_facility()
    {
        $data = [];
        $rules = [
            'Name' => 'required',
            'Location' => 'required',
            'FacilityType' => 'required',
        ];
        $messages = [
            'Name.required' => 'Facility.Name is required.',
            'Location.required' => 'Facility.Location is required.',
            'FacilityType.required' => 'Facility.FacilityType is required.',
        ];

        $v = Validator::make($data, $rules, $messages);
        $this->assertTrue($v->fails());
        $this->assertTrue($v->errors()->has('Name'));
        $this->assertTrue($v->errors()->has('Location'));
        $this->assertTrue($v->errors()->has('FacilityType'));
    }

    /** Uniqueness (Name + Location) */
    public function test_uniqueness_rule_name_and_location_must_be_unique()
    {
        Facility::create([
            'Name' => 'Innovation Lab',
            'Location' => 'Kampala',
            'FacilityType' => 'Lab'
        ]);

        $data = [
            'Name' => 'innovation lab',
            'Location' => 'Kampala',
            'FacilityType' => 'Lab'
        ];

        $rules = [
            'Name' => [
                'required',
                function ($attr, $value, $fail) use ($data) {
                    if (Facility::whereRaw('LOWER(Name) = ? AND LOWER(Location) = ?', [strtolower($value), strtolower($data['Location'])])->exists()) {
                        $fail('A facility with this name already exists at this location.');
                    }
                }
            ],
            'Location' => 'required',
            'FacilityType' => 'required'
        ];

        $v = Validator::make($data, $rules);
        $this->assertTrue($v->fails());
        $this->assertEquals('A facility with this name already exists at this location.', $v->errors()->first('Name'));
    }

    /** Deletion Constraints */
    public function test_deletion_constraints_rule_prevents_delete_with_dependent_records()
    {
        $facility = Facility::create([
            'Name' => 'Central Lab',
            'Location' => 'Kampala',
            'FacilityType' => 'Lab',
            'Capabilities' => ['CNC']
        ]);

        // Create minimal program for project FK
        $program = Program::create(['Name' => 'P1', 'Description' => 'd']);

        // Add dependent records: service, equipment, project
        Service::create([
            'facility_id' => $facility->id,
            'Name' => 'CNC Machining',
            'Category' => 'Machining',
            'SkillType' => 'Hardware'
        ]);

        Equipment::create([
            'facility_id' => $facility->id,
            'Name' => '3D Printer',
            'InventoryCode' => 'INV-001',
            'Capability' => 'Printing',
            'Domain' => 'Electronics',
            'Type' => 'Hardware' 
        ]);

        Project::create([
            'title' => 'Device Build',
            'description' => 'x',
            'program_id' => $program->id,
            'facility_id' => $facility->id,
            'prototype_stage' => 'prototype',
            'nature_of_project' => 'prototype'
        ]);

        // Expect deletion to be guarded (model should throw)
        $this->expectException(\Exception::class);
        $facility->delete();
    }

    /** Capabilities rule */
    public function test_capabilities_must_be_populated_when_services_or_equipment_exist()
    {
        $facility = Facility::create([
            'Name' => 'Maker Space',
            'Location' => 'Lira',
            'FacilityType' => 'Workshop',
            'Capabilities' => [] // empty
        ]);

        // create a service referencing this facility
        Service::create([
            'facility_id' => $facility->id,
            'Name' => 'PCB Fabrication',
            'Category' => 'Fabrication',
            'SkillType' => 'Hardware'
        ]);

        // run validation that enforces the rule
        $data = ['Capabilities' => $facility->Capabilities];
        $rules = ['Capabilities' => 'nullable|array'];
        $v = Validator::make($data, $rules);
        $v->after(function ($validator) use ($facility) {
            $hasServicesOrEquipment = $facility->services()->count() > 0 || $facility->equipment()->count() > 0;
            if ($hasServicesOrEquipment && empty($facility->Capabilities)) {
                $validator->errors()->add('Capabilities', 'Facility.Capabilities must be populated when Services/Equipment exist.');
            }
        });

        $this->assertTrue($v->fails());
        $this->assertTrue($v->errors()->has('Capabilities'));
    }
}
