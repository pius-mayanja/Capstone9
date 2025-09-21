<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Facility;
use App\Models\Program;

class Project extends Model
{
    // use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'nature_of_project',
        'facility_id',
        'program_id',
        'prototype_stage',
    ];

    // Relationships
    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function outcomes()
    {
        return $this->hasMany(Outcome::class);
    }
}


// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Project extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'title',
//         'description',
//     ];
// }
