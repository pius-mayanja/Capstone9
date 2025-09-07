<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Program extends Model
{
    protected $primaryKey = 'ProgramId';

    protected $fillable = [
        'Name',
        'Description',
        'NationalAlignment',
        'FocusAreas',
        'Phases'
    ];

    protected $casts = [
        'FocusAreas' => 'array',
        'Phases' => 'array',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'ProgramId');
    }
}

