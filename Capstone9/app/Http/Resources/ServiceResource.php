<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'ServiceId' => $this->ServiceId,
            'FacilityId' => $this->FacilityId,
            'Name' => $this->Name,
            'Description' => $this->Description,
            'Category' => $this->Category,
            'SkillType' => $this->SkillType,
        ];
    }
}
