<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Facility;

class Service extends Model
{
    public $incrementing = true;   // ensure primary key is auto-increment
    protected $keyType = 'int';    // primary key type

    protected $fillable = [
        'facility_id',
        'Name',
        'Description',
        'Category',
        'SkillType'
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id');
    }

   
}
