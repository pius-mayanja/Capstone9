<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
// If your Project model is in a different namespace or file, update the import accordingly.
// For example, if it's in 'App\Project', use:
// use App\Project;

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

