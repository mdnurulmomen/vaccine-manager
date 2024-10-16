<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\VaccineCenterRepositoryInterface;

class VaccineCenterController extends Controller
{
    private $vaccineCenterRepository;

    public function __construct(VaccineCenterRepositoryInterface $vaccineCenterRepository)
    {
        $this->vaccineCenterRepository = $vaccineCenterRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->vaccineCenterRepository->index();
    }
}
