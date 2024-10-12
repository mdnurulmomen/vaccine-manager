<?php

namespace App\Http\Repositories;

use App\Models\VaccineCenter;
use App\Http\Resources\API\V1\VaccineCenterResource;
use App\Http\Interfaces\VaccineCenterRepositoryInterface;

class VaccineCenterRepository implements VaccineCenterRepositoryInterface
{
    public function index()
    {
        return VaccineCenterResource::collection(VaccineCenter::all());
    }
}
