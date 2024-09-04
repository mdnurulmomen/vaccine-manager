<?php

namespace App\Http\Repositories;

use App\Models\User;
use App\Enums\UserType;
use App\Http\Interfaces\MyUserRepositoryInterface;

class MyUserRepository implements MyUserRepositoryInterface
{
    public function myAllUsers()
    {
        $users = User::where('user_type', UserType::Polititian->value);

        $currentUser = User::with(['skills', 'interests', 'parties'])->find(request()->route('id'));

        if (! $currentUser->skills->isEmpty()) {
            $users->whereHas('skills', function ($query) use ($currentUser) {
                $query->whereIn('skill_id', $currentUser->skills->pluck('skill_id')->all());
            });
        } else if (! $currentUser->interests->isEmpty()) {
            $users->whereHas('interests', function ($query) use ($currentUser) {
                $query->whereIn('interest_id', $currentUser->interests->pluck('interest_id')->all());
            });
        } else if (! $currentUser->parties->isEmpty()) {
            $users->whereHas('parties', function ($query) use ($currentUser) {
                $query->whereIn('political_party_id', $currentUser->parties->pluck('political_party_id')->all());
            });
        }

        return $users->latest('id')->paginate(10);

    }
}
