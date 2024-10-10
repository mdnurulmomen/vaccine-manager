<?php

namespace App\Http\Repositories;

use App\Models\VaccineCenter;
use App\Http\Resources\VaccineCenterResource;
use App\Http\Interfaces\VaccineCenterRepositoryInterface;

class VaccineCenterRepository implements VaccineCenterRepositoryInterface
{
    public function vaccineAllCenters()
    {
        return VaccineCenterResource::collection(VaccineCenter::all());
    }
}
