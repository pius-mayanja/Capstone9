<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Facility;

class Service extends Model
{
    public $incrementing = true;   // ensure primary key is auto-increment
    protected $keyType = 'int';    // primary key type

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

    // 👇 This tells Laravel to use ServiceId in routes
   
}
