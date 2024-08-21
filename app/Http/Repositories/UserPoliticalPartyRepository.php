<?php

namespace App\Http\Repositories;

use App\Models\UserPoliticalParty;
use App\Http\Interfaces\UserPoliticalPartyRepositoryInterface;

class UserPoliticalPartyRepository implements UserPoliticalPartyRepositoryInterface
{
    public function allUserPoliticalPartys()
    {
        $query = UserPoliticalParty::query();
        
        if (request()->filled('user_id')) {
            $query->where('user_id', request()->user_id);
        }
        
        return $query->latest('id')->paginate(10);
    }

    public function storeUserPoliticalParty($data)
    {
        return UserPoliticalParty::firstOrCreate($data);
    }

    public function updateUserPoliticalParty($data, UserPoliticalParty $userPoliticalParty)
    {
        $userPoliticalParty->update($data);
    }

    public function destroyUserPoliticalParty(UserPoliticalParty $userPoliticalParty)
    {
        $userPoliticalParty->delete();
    }
}