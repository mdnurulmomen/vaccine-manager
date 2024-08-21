<?php

namespace App\Http\Repositories;

use App\Models\UserType;
use App\Http\Interfaces\UserTypeRepositoryInterface;

class UserTypeRepository implements UserTypeRepositoryInterface
{
    public function allUserTypes()
    {
        return UserType::latest('id')->paginate(10);
    }

    public function storeUserType($data)
    {
        return UserType::create($data);
    }

    public function updateUserType($data, UserType $userType)
    {
        $userType->update($data);
    }

    public function destroyUserType(UserType $userType)
    {
        $userType->delete();
    }
}