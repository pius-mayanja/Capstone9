<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Facility extends Model
{
     use HasFactory;
    // protected $primaryKey = 'FacilityId';

    protected $fillable = [
        'Name',
        'Location',
        'Description',
        'PartnerOrganization',
        'FacilityType',
        'Capabilities'
    ];

    protected $casts = [
        'Capabilities' => 'array',
    ];

    public function services()
    {
        return $this->hasMany(Service::class, 'facility_id');
    }
}

