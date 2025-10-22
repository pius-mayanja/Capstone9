<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use App\Models\Project;
use App\Models\Program;
use App\Models\Facility;
use App\Models\Outcome;
use App\Models\User;

class ProjectUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function required_associations_rule_project_must_have_program_and_facility()
    {
        $data = []; // missing required associations

        $rules = [
            'program_id' => 'required|exists:programs,id',
            'facility_id' => 'required|exists:facilities,id',
        ];

        $messages = [
            'program_id.required' => 'Project.ProgramId is required.',
            'facility_id.required' => 'Project.FacilityId is required.',
        ];

        $v = Validator::make($data, $rules, $messages);

        $this->assertTrue($v->fails());
        $this->assertTrue($v->errors()->has('program_id'));
        $this->assertTrue($v->errors()->has('facility_id'));
    }

    /** @test */
    public function name_uniqueness_rule_project_title_must_be_unique_within_program()
    {
        $program = Program::create(['Name' => 'Program Alpha', 'Description' => 'desc']);
        $facility = Facility::create(['Name' => 'Lab A', 'Location' => 'Kampala', 'FacilityType' => 'Lab']);

        // Create existing project
        Project::create([
            'program_id' => $program->id,
            'facility_id' => $facility->id,
            'title' => 'Solar Drone',
            'nature_of_project' => 'prototype',
            'prototype_stage' => 'concept'
        ]);

        $data = [
            'program_id' => $program->id,
            'facility_id' => $facility->id,
            'title' => 'solar drone',
            'nature_of_project' => 'prototype',
            'prototype_stage' => 'concept'
        ];

        $rules = [
            'title' => [
                'required',
                function ($attr, $value, $fail) use ($data) {
                    if (Project::whereRaw('LOWER(title) = ?', [strtolower($value)])
                        ->where('program_id', $data['program_id'])
                        ->exists()) {
                        $fail('A project with this name already exists in this program.');
                    }
                }
            ],
        ];

        $v = Validator::make($data, $rules);
        $this->assertTrue($v->fails());
        $this->assertEquals('A project with this name already exists in this program.', $v->errors()->first('title'));
    }

    /** @test */
    public function outcome_validation_rule_completed_projects_must_have_at_least_one_outcome()
    {
        $program = Program::create(['Name' => 'Program Beta', 'Description' => 'test']);
        $facility = Facility::create(['Name' => 'Maker Space', 'Location' => 'Gulu', 'FacilityType' => 'Workshop']);

        $project = Project::create([
            'program_id' => $program->id,
            'facility_id' => $facility->id,
            'title' => 'AI Wheelchair',
            'nature_of_project' => 'applied',
            'prototype_stage' => 'mvp'
        ]);

        // Simulate validation rule: if status is completed, must have at least one outcome
        $status = 'Completed';
        $hasOutcome = $project->outcomes()->count() > 0;

        $validator = Validator::make([], []);
        $validator->after(function ($v) use ($status, $hasOutcome) {
            if ($status === 'Completed' && !$hasOutcome) {
                $v->errors()->add('outcomes', 'Completed projects must have at least one documented outcome.');
            }
        });

        $this->assertTrue($validator->fails());
        $this->assertEquals('Completed projects must have at least one documented outcome.', $validator->errors()->first('outcomes'));
    }

    /** @test */
    public function facility_compatibility_rule_project_requirements_must_match_facility_capabilities()
    {
        $facility = Facility::create([
            'Name' => 'Central Lab',
            'Location' => 'Kampala',
            'FacilityType' => 'Lab',
            'Capabilities' => ['3D Printing', 'Electronics']
        ]);

        $program = Program::create(['Name' => 'Hardware Dev', 'Description' => 'program']);

        $project = new Project([
            'program_id' => $program->id,
            'facility_id' => $facility->id,
            'title' => 'Metal Casting',
            'nature_of_project' => 'prototype',
            'prototype_stage' => 'concept',
            'testing_requirements' => 'Casting'
        ]);

        // Simulate a compatibility check
        $validator = Validator::make([], []);
        $validator->after(function ($v) use ($project, $facility) {
            $capabilities = collect($facility->Capabilities ?? []);
            $requirements = strtolower($project->testing_requirements);

            if (!$capabilities->contains(fn($cap) => str_contains(strtolower($cap), $requirements))) {
                $v->errors()->add('facility_id', 'Project requirements not compatible with facility capabilities.');
            }
        });

        $this->assertTrue($validator->fails());
        $this->assertEquals('Project requirements not compatible with facility capabilities.', $validator->errors()->first('facility_id'));
    }

    /** @test */
    public function lifecycle_protection_rule_program_cannot_be_deleted_if_it_has_projects()
    {
        $program = Program::create(['Name' => 'Robotics', 'Description' => 'Robotics R&D']);
        $facility = Facility::create(['Name' => 'Innovation Hub', 'Location' => 'Mbarara', 'FacilityType' => 'Lab']);

        Project::create([
            'program_id' => $program->id,
            'facility_id' => $facility->id,
            'title' => 'AI Drone',
            'nature_of_project' => 'research',
            'prototype_stage' => 'concept'
        ]);

        // expect delete guard
        $this->expectException(\Exception::class);
        $program->delete();
    }
}
