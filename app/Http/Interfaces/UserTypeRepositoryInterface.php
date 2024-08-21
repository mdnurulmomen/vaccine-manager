<?php
namespace App\Http\Interfaces;

use App\Models\UserType;

Interface UserTypeRepositoryInterface{
    public function allUserTypes();
    public function storeUserType($data);
    public function updateUserType($data, UserType $userType); 
    public function destroyUserType(UserType $userType);
}