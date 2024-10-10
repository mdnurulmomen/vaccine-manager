<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserVaccineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->user['name'],
            'user' => new VaccineCenterResource($this->whenLoaded('user')),
            'vaccine_center' => new VaccineCenterResource($this->whenLoaded('center')),
            'vaccine_center_id' => $this->vaccine_center_id,
            'status' => $this->is_completed,
        ];
    }
}
