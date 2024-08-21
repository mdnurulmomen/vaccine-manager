<?php
namespace App\Http\Interfaces;

use App\Models\UserLocation;

Interface UserLocationRepositoryInterface{
    public function allUserLocations();
    public function storeUserLocation($data);
    public function updateUserLocation($data, UserLocation $userLocation); 
    public function destroyUserLocation(UserLocation $userLocation);
}