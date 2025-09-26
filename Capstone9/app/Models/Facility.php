<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class Facility extends Model
{
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

