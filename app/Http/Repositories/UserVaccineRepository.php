<?php

namespace App\Http\Repositories;

use App\Models\UserVaccine;
use App\Http\Resources\UserVaccineResource;
use App\Http\Resources\UserVaccineCollection;
use App\Http\Interfaces\UserVaccineRepositoryInterface;

class UserVaccineRepository implements UserVaccineRepositoryInterface
{
    public function index()
    {
        if (request()->route('perPage')) {
            return new UserVaccineCollection(UserVaccine::with(['user', 'center'])->paginate(request()->route('perPage')));
        } else {
            return UserVaccineResource::collection(UserVaccine::with(['user', 'center'])->get());
        }
    }

    public function store($data)
    {
        UserVaccine::firstOrCreate($data);
    }

    public function update($data, UserVaccine $userVaccine)
    {
        $userVaccine->update($data);
    }

    public function destroy(UserVaccine $userVaccine)
    {
        $userVaccine->delete();
    }
}
