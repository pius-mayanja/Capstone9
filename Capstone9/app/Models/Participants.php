<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Participants extends Model
{
    protected $primaryKey = 'ParticipantId';
    
    protected $fillable = [
        'FullName',
        'Email',
        'Affiliation',
        'Specialization',
        'Description',
        'CrossSkillTrained',
        'Institution'
    ];  
public function projects()
{
    return $this->belongsTo(Project::class, 'ProjectId');
}
}
