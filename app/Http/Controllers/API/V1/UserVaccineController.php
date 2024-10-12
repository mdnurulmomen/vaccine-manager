<?php

namespace App\Http\Controllers\API\V1;

use App\Models\UserVaccine;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\UserVaccineStoreRequest;
use App\Http\Requests\API\V1\UserVaccineUpdateRequest;
use App\Http\Interfaces\UserVaccineRepositoryInterface;

class UserVaccineController extends Controller
{
    private $userVaccineRepository;

    public function __construct(UserVaccineRepositoryInterface $userVaccineRepository)
    {
        $this->userVaccineRepository = $userVaccineRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->userVaccineRepository->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserVaccineStoreRequest $request)
    {
        $this->userVaccineRepository->store($request->validated());
        return $this->userVaccineRepository->index();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserVaccineUpdateRequest $request, UserVaccine $userVaccine)
    {
        $this->userVaccineRepository->update($request->validated(), $userVaccine);
        return $this->userVaccineRepository->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserVaccine $userVaccine)
    {
        $this->userVaccineRepository->destroy($userVaccine);
        return $this->userVaccineRepository->index();
    }
}
