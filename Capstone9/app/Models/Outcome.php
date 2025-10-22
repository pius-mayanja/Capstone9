<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'title', 'description', 'artifact_link',
        'outcome_type', 'quality_certification', 'commercialization_status'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}