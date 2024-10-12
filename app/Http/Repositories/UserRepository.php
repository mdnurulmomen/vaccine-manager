<?php

namespace App\Http\Repositories;

use App\Models\User;
use App\Http\Interfaces\UserRepositoryInterface;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;

class UserRepository implements UserRepositoryInterface
{
    public function index()
    {
        if (request()->has('perPage')) {
            return new UserCollection(User::latest()->paginate(request()->input('perPage')));
        } else {
            return UserResource::collection(User::latest()->get());
        }
    }

    public function unscheduledUserIndex()
    {
        if (request()->has('perPage')) {
            return new UserCollection(User::doesntHave('vaccine')->user()->latest()->paginate(request()->input('perPage')));
        } else {
            return UserResource::collection(User::doesntHave('vaccine')->user()->latest()->get());
        }
    }

    public function searchUserNID($data)
    {
        return new UserResource(User::with('vaccine')->firstWhere('nid', $data['nid']));
    }
}
