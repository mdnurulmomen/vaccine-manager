<?php

namespace App\Http\Controllers;

use App\Models\UserVaccine;
use App\Http\Requests\UserVaccineStoreRequest;
use App\Http\Requests\UserVaccineUpdateRequest;
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
        return $this->userVaccineRepository->allUserVaccines();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserVaccineStoreRequest $request)
    {
        $this->userVaccineRepository->storeUserVaccine($request->validated());
        return $this->userVaccineRepository->allUserVaccines();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserVaccineUpdateRequest $request, UserVaccine $userVaccine)
    {
        $this->userVaccineRepository->updateUserVaccine($request->validated(), $userVaccine);
        return $this->userVaccineRepository->allUserVaccines();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserVaccine $userSkill)
    {
        $this->userVaccineRepository->destroyUserVaccine($userSkill);
        return $this->userVaccineRepository->allUserVaccines();
    }
}
