<?php

namespace App\Http\Repositories;

use App\Models\UserLocation;
use App\Http\Interfaces\UserLocationRepositoryInterface;

class UserLocationRepository implements UserLocationRepositoryInterface
{
    public function allUserLocations()
    {
        $query = UserLocation::query()->with('location');

        if (request()->filled('user_id')) {
            $query->where('user_id', request()->user_id);
        }

        return $query->latest('id')->paginate(10);
    }

    public function storeUserLocation($data)
    {
        return UserLocation::firstOrCreate($data);
    }

    public function updateUserLocation($data, UserLocation $userLocation)
    {
        $userLocation->update($data);
    }

    public function destroyUserLocation(UserLocation $userLocation)
    {
        $userLocation->delete();
    }
}
