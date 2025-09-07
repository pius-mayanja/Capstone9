<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Facility;

class Service extends Model
{
    protected $primaryKey = 'ServiceId';

    protected $fillable = [
        'FacilityId',
        'Name',
        'Description',
        'Category',
        'SkillType'
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'FacilityId');
    }
}
