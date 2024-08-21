<?php
namespace App\Http\Interfaces;

use App\Models\UserInterest;

Interface UserInterestRepositoryInterface{
    public function allUserInterests();
    public function storeUserInterest($data);
    public function updateUserInterest($data, UserInterest $userInterest); 
    public function destroyUserInterest(UserInterest $userInterest);
}