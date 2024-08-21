<?php

namespace App\Http\Controllers;

use App\Models\UserLocation;
use App\Http\Requests\UserLocationStoreRequest;
use App\Http\Requests\UserLocationUpdateRequest;
use App\Http\Interfaces\UserLocationRepositoryInterface;

class UserLocationController extends Controller
{
    private $userLocationRepository;

    public function __construct(UserLocationRepositoryInterface $userLocationRepository)
    {
        $this->userLocationRepository = $userLocationRepository;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->userLocationRepository->allUserLocations();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserLocationStoreRequest $request)
    {
        $this->userLocationRepository->storeUserLocation($request->validated());
        return $this->userLocationRepository->allUserLocations();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserLocationUpdateRequest $request, UserLocation $userLocation)
    {
        $this->userLocationRepository->updateUserLocation($request->validated(), $userLocation);
        return $this->userLocationRepository->allUserLocations();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserLocation $userLocation)
    {
        $this->userLocationRepository->destroyUserLocation($userLocation);
        return $this->userLocationRepository->allUserLocations();
    }
}
