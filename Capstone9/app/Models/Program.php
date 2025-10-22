<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Project;
// If your Project model is in a different namespace or file, update the import accordingly.
// For example, if it's in 'App\Project', use:
// use App\Project;


class Program extends Model
{
    use HasFactory;

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
        return $this->hasMany(Project::class, 'program_id');
    }

    protected static function boot()
    {
    parent::boot();

    static::deleting(function ($program) {
        if ($program->projects()->count() > 0) {
            throw new \Exception("Program has Projects; archive or reassign before delete.");
        }
    });
    }

}

