<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Facility;

class Service extends Model
{
    use HasFactory;

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

    /**
     * Prevent deletion of a Service if any Project in the same Facility
     * references this Service's Category in its TestingRequirements.
     */
    protected static function booted()
    {
        static::deleting(function ($service) {
            $projectExists = \App\Models\Project::where('facility_id', $service->facility_id)
                ->whereJsonContains('TestingRequirements', $service->Category)
                ->exists();

            if ($projectExists) {
                throw new \Exception('Service in use by Project testing requirements.');
            }
        });
    }
}
