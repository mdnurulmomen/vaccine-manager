<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Http\Requests\LocationStoreRequest;
use App\Http\Requests\LocationUpdateRequest;
use App\Http\Interfaces\LocationRepositoryInterface;

class LocationController extends Controller
{
    private $locationRepository;

    public function __construct(LocationRepositoryInterface $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->locationRepository->allLocations();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocationStoreRequest $request)
    {
        $this->locationRepository->storeLocation($request->validated());
        return $this->locationRepository->allLocations();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocationUpdateRequest $request, Location $location)
    {
        $this->locationRepository->updateLocation($request->validated(), $location);
        return $this->locationRepository->allLocations();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $this->locationRepository->destroyLocation($location);
        return $this->locationRepository->allLocations();
    }
}
