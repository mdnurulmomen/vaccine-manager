<?php

namespace App\Http\Repositories;

use App\Models\UserVaccine;
use App\Http\Resources\API\V1\UserVaccineResource;
use App\Http\Resources\API\V1\UserVaccineCollection;
use App\Http\Interfaces\UserVaccineRepositoryInterface;

class UserVaccineRepository implements UserVaccineRepositoryInterface
{
    public function index()
    {
        if (request()->has('perPage')) {
            return new UserVaccineCollection(
                UserVaccine::with(['user', 'center'])
                ->where('is_completed', false)
                ->paginate(request()->input('perPage'))
            );
        } else {
            return UserVaccineResource::collection(
                UserVaccine::with(['user', 'center'])
                ->where('is_completed', false)
                ->get()
            );
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
