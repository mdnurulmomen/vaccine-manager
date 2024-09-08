<?php

namespace App\Http\Repositories;

use App\Models\UserInterest;
use App\Http\Interfaces\UserInterestRepositoryInterface;

class UserInterestRepository implements UserInterestRepositoryInterface
{
    public function allUserInterests()
    {
        $query = UserInterest::query()->with('interest')
        ->where('user_id', request()->user()->id);

        return $query->latest('id')->paginate(10);
    }

    public function storeUserInterest($data)
    {
        UserInterest::firstOrCreate($data);
    }

    public function updateUserInterest($data, UserInterest $userInterest)
    {
        $userInterest->update($data);
    }

    public function destroyUserInterest(UserInterest $userInterest)
    {
        $userInterest->delete();
    }
}
