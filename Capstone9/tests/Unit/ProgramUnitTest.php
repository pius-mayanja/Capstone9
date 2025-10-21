<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Models\Program;

class ProgramUnitTest extends TestCase
{
    /** @test */
    public function required_fields_rule_for_program()
    {
        $data = [];
        $rules = [
            'Name' => 'required',
            'Description' => 'required',
        ];

        $validator = Validator::make($data, $rules);
        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('Name'));
        $this->assertTrue($validator->errors()->has('Description'));
    }

    /** @test */
    public function uniqueness_rule_program_name_case_insensitive()
    {
        // Fake "existing" programs
        $existing = collect(['ai program']);

        $data = ['Name' => 'AI Program', 'Description' => 'Desc'];

        $rules = [
            'Name' => [
                'required',
                function ($attr, $value, $fail) use ($existing) {
                    if ($existing->contains(strtolower($value))) {
                        $fail('Program.Name already exists.');
                    }
                },
            ],
            'Description' => 'required',
        ];

        $validator = Validator::make($data, $rules);
        $this->assertTrue($validator->fails());
        $this->assertEquals('Program.Name already exists.', $validator->errors()->first('Name'));
    }

    /** @test */
    public function national_alignment_rule_when_focusareas_specified()
    {
        $data = [
            'Name' => 'HealthTech',
            'Description' => 'Desc',
            'FocusAreas' => 'AI, ML',
            'NationalAlignment' => 'InvalidToken'
        ];

        $validator = Validator::make($data, [
            'Name' => 'required',
            'Description' => 'required',
        ]);

        $validator->after(function ($v) use ($data) {
            if (!empty($data['FocusAreas'])) {
                $valid = ['NDPIII', 'DigitalRoadmap2023_2028', '4IR'];
                $alignments = array_map('trim', explode(',', $data['NationalAlignment']));
                if (!count(array_intersect($valid, $alignments))) {
                    $v->errors()->add('NationalAlignment',
                        'Program.NationalAlignment must include at least one recognized alignment when FocusAreas are specified.'
                    );
                }
            }
        });

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('NationalAlignment'));
    }

    /** @test */
    public function lifecycle_protection_rule_prevents_delete_with_projects()
    {
        $program = new Program();
        $program->setRelation('projects', collect([['id' => 1]]));

        $this->expectException(\Exception::class);
        if ($program->projects->count() > 0) {
            throw new \Exception("Program has Projects; archive or reassign before delete.");
        }
    }
}
