<?php

namespace App\Http\Resources\API\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'nid' => $this->nid,
            'vaccine_center' => new VaccineCenterResource($this->whenLoaded('center')),
            'vaccine_center_id' => $this->vaccine_center_id,
        ];
    }
}
