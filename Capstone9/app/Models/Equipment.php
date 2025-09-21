<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $primaryKey = 'EquipmentId';

    protected $fillable = [
        'facility_id',
        'Name',
        'Type',
        'Capability',
        'Domain',
        'Description',
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id');
    }

}

