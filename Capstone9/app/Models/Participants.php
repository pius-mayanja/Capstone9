<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

}
