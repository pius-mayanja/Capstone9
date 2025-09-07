<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id', 'facility_id', 'title', 'nature_of_project',
        'description', 'innovation_focus', 'prototype_stage',
        'testing_requirements', 'commercialization_plan'
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    public function outcomes()
    {
        return $this->hasMany(Outcome::class);
    }
}
