<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $primaryKey = 'EquipmentId';

    protected $fillable = [
        'Name',
        'Type',
        'Capability',
        'Domain',
        'Description',
        'FacilityId',
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'FacilityId');
    }
}

