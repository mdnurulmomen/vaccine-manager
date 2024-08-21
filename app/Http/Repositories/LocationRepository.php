<?php

namespace App\Http\Repositories;

use App\Models\Location;
use App\Http\Interfaces\LocationRepositoryInterface;

class LocationRepository implements LocationRepositoryInterface
{
    public function allLocations()
    {
        return Location::latest()->paginate(10);
    }

    public function storeLocation($data)
    {
        return Location::create($data);
    }

    public function updateLocation($data, Location $location)
    {
        $location->update($data);
    }

    public function destroyLocation(Location $location)
    {
        $location->delete();
    }
}