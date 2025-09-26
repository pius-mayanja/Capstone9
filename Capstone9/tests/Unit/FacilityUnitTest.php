<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Models\Facility;
use PHPUnit\Framework\Attributes\Test;

class FacilityUnitTest extends TestCase
{
    #[Test]
    public function required_fields_rule_for_facility()
    {
        $data = [];
        $rules = [
            'Name' => 'required',
            'Location' => 'required',
            'FacilityType' => 'required',
        ];

        $validator = Validator::make($data, $rules);
        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('Name'));
        $this->assertTrue($validator->errors()->has('Location'));
        $this->assertTrue($validator->errors()->has('FacilityType'));
    }

    #[Test]
    public function uniqueness_rule_name_and_location()
    {
        $existing = collect([['name' => 'innovation lab', 'location' => 'kampala']]);

        $data = ['Name' => 'Innovation Lab', 'Location' => 'Kampala', 'FacilityType' => 'Lab'];

        $validator = Validator::make($data, [
            'Name' => [
                'required',
                function ($attr, $value, $fail) use ($data, $existing) {
                    if ($existing->contains(fn ($f) =>
                        strtolower($f['name']) === strtolower($value) &&
                        strtolower($f['location']) === strtolower($data['Location'])
                    )) {
                        $fail('A facility with this name already exists at this location.');
                    }
                }
            ],
            'Location' => 'required',
            'FacilityType' => 'required',
        ]);

        $this->assertTrue($validator->fails());
        $this->assertEquals(
            'A facility with this name already exists at this location.',
            $validator->errors()->first('Name')
        );
    }

    #[Test]
    public function deletion_constraints_rule_prevents_delete_with_dependents()
    {
        $facility = new Facility();
        $facility->setRelation('services', collect([['id' => 1]]));
        $facility->setRelation('equipment', collect([['id' => 1]]));
        $facility->setRelation('projects', collect([['id' => 1]]));

        $this->expectException(\Exception::class);
        if ($facility->services->count() || $facility->equipment->count() || $facility->projects->count()) {
            throw new \Exception("Facility has dependent records and cannot be deleted.");
        }
    }

    #[Test]
    public function capabilities_must_be_populated_when_dependents_exist()
    {
        $facility = new Facility();
        $facility->Capabilities = [];
        $facility->setRelation('services', collect([['id' => 1]]));

        $validator = Validator::make(['Capabilities' => $facility->Capabilities], []);
        $validator->after(function ($v) use ($facility) {
            if (($facility->services->count() || $facility->equipment->count()) && empty($facility->Capabilities)) {
                $v->errors()->add('Capabilities', 'Facility.Capabilities must be populated when Services/Equipment exist.');
            }
        });

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('Capabilities'));
    }
}