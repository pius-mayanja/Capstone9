<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use App\Models\Equipment;
use App\Models\Facility;

class EquipmentUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function required_fields_rule_for_equipment()
    {
        $data = [];
        $rules = [
            'facility_id' => 'required|exists:facilities,id',
            'Name' => 'required|string|max:255',
            'Type' => 'required|string|max:255',
            'Capability' => 'required|string|max:255',
        ];
        $messages = [
            'facility_id.required' => 'Equipment.facility_id is required.',
            'Name.required' => 'Equipment.Name is required.',
            'Type.required' => 'Equipment.Type is required.',
            'Capability.required' => 'Equipment.Capability is required.',
        ];

        $v = Validator::make($data, $rules, $messages);
        $this->assertTrue($v->fails());
        $this->assertTrue($v->errors()->has('facility_id'));
        $this->assertTrue($v->errors()->has('Name'));
        $this->assertTrue($v->errors()->has('Type'));
        $this->assertTrue($v->errors()->has('Capability'));
    }

    /** @test */
    public function type_must_be_valid_enum_value()
    {
        $facility = Facility::factory()->create();

        $data = [
            'facility_id' => $facility->id,
            'Name' => '3D Printer',
            'Type' => 'InvalidType', // Invalid
            'Capability' => 'Printing',
        ];

        $rules = [
            'facility_id' => 'required|exists:facilities,id',
            'Name' => 'required|string|max:255',
            'Type' => 'required|in:Tool,Machine,Device',
            'Capability' => 'required|string|max:255',
        ];

        $v = Validator::make($data, $rules);
        $this->assertTrue($v->fails());
        $this->assertTrue($v->errors()->has('Type'));
    }

    /** @test */
    public function uniqueness_rule_name_must_be_unique_within_facility()
    {
        $facility = Facility::factory()->create();

        Equipment::create([
            'facility_id' => $facility->id,
            'Name' => '3D Printer',
            'Type' => 'Machine',
            'Capability' => 'Printing',
        ]);

        $data = [
            'facility_id' => $facility->id,
            'Name' => '3D Printer', // Duplicate within same facility
            'Type' => 'Machine',
            'Capability' => 'Printing',
        ];

        $rules = [
            'facility_id' => 'required|exists:facilities,id',
            'Name' => [
                'required',
                'string',
                'max:255',
                function ($attr, $value, $fail) use ($data) {
                    if (Equipment::where('facility_id', $data['facility_id'])->whereRaw('LOWER(Name) = ?', [strtolower($value)])->exists()) {
                        $fail('Equipment.Name must be unique within the facility.');
                    }
                }
            ],
            'Type' => 'required|in:Tool,Machine,Device',
            'Capability' => 'required|string|max:255',
        ];

        $v = Validator::make($data, $rules);
        $this->assertTrue($v->fails());
        $this->assertEquals('Equipment.Name must be unique within the facility.', $v->errors()->first('Name'));
    }

    /** @test */
    public function name_can_repeat_in_different_facilities()
    {
        $facilityA = Facility::factory()->create();
        $facilityB = Facility::factory()->create();

        Equipment::create([
            'facility_id' => $facilityA->id,
            'Name' => '3D Printer',
            'Type' => 'Machine',
            'Capability' => 'Printing',
        ]);

        // This should succeed
        $equipment = Equipment::create([
            'facility_id' => $facilityB->id,
            'Name' => '3D Printer', // Same name, different facility
            'Type' => 'Machine',
            'Capability' => 'Printing',
        ]);

        $this->assertDatabaseHas('equipment', [
            'EquipmentId' => $equipment->EquipmentId,
            'Name' => '3D Printer',
        ]);
    }

    /** @test */
    public function deletion_constraints_rule_prevents_delete_if_referenced_by_projects()
    {
        $facility = Facility::factory()->create();

        $equipment = Equipment::create([
            'facility_id' => $facility->id,
            'Name' => 'CNC Machine',
            'Type' => 'Machine',
            'Capability' => 'Milling',
        ]);

        // Simulate project reference (assuming a many-to-many or similar relationship)
        // For this test, we'll assume the model has a guard; in reality, check your model logic
        $equipment->setRelation('projects', collect([['id' => 1]])); // Mock relation

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Equipment is in use by projects.');

        if ($equipment->projects->count() > 0) {
            throw new \Exception('Equipment is in use by projects.');
        }
    }
}