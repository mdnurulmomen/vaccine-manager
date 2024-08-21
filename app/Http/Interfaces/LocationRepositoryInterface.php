<?php
namespace App\Http\Interfaces;

use App\Models\Location;

Interface LocationRepositoryInterface{
    public function allLocations();
    public function storeLocation($data);
    public function updateLocation($data, Location $location); 
    public function destroyLocation(Location $location);
}