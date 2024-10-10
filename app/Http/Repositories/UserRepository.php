<?php

namespace App\Http\Repositories;

use App\Models\User;
use App\Http\Interfaces\UserRepositoryInterface;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;

class UserRepository implements UserRepositoryInterface
{
    public function allUsers()
    {
        if (request()->route('perPage')) {
            return new UserCollection(User::latest()->paginate(request()->route('perPage')));
        } else {
            return UserResource::collection(User::latest()->get());
        }
    }

    public function allUnscheduledUsers()
    {
        if (request()->route('perPage')) {
            return new UserCollection(User::doesntHave('vaccine')->latest()->paginate(request()->route('perPage')));
        } else {
            return UserResource::collection(User::doesntHave('vaccine')->latest()->get());
        }
    }
}
