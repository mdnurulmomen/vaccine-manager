<?php
namespace App\Http\Interfaces;

use App\Models\UserPoliticalParty;

Interface UserPoliticalPartyRepositoryInterface{
    public function allUserPoliticalPartys();
    public function storeUserPoliticalParty($data);
    public function updateUserPoliticalParty($data, UserPoliticalParty $userPoliticalParty); 
    public function destroyUserPoliticalParty(UserPoliticalParty $userPoliticalParty);
}