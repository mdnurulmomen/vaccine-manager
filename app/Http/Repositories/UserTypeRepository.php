<?php

namespace App\Http\Repositories;

use App\Enums\UserType;
use App\Http\Interfaces\UserTypeRepositoryInterface;

class UserTypeRepository implements UserTypeRepositoryInterface
{
    public function allUserTypes()
    {
        return UserType::values();
    }
}
