<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Facility;
use App\Models\Program;


use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;


    protected $casts = [
        'TestingRequirements' => 'array',
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
