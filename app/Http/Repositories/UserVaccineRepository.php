<?php

namespace App\Http\Repositories;

use App\Models\UserVaccine;
use App\Http\Resources\UserVaccineResource;
use App\Http\Resources\UserVaccineCollection;
use App\Http\Interfaces\UserVaccineRepositoryInterface;

class UserVaccineRepository implements UserVaccineRepositoryInterface
{
    public function allUserVaccines()
    {
        if (request()->route('perPage')) {
            return new UserVaccineCollection(UserVaccine::with(['user', 'center'])->paginate(request()->route('perPage')));
        } else {
            return UserVaccineResource::collection(UserVaccine::with(['user', 'center'])->get());
        }
    }

    public function storeUserVaccine($data)
    {
        UserVaccine::firstOrCreate($data);
    }

    public function updateUserVaccine($data, UserVaccine $userVaccine)
    {
        $userVaccine->update($data);
    }

    public function destroyUserVaccine(UserVaccine $userVaccine)
    {
        $userVaccine->delete();
    }
}
