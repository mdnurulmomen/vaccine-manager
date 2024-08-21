<?php

namespace App\Http\Controllers;

use App\Models\UserPoliticalParty;
use App\Http\Requests\UserPoliticalPartyStoreRequest;
use App\Http\Requests\UserPoliticalPartyUpdateRequest;
use App\Http\Interfaces\UserPoliticalPartyRepositoryInterface;

class UserPoliticalPartyController extends Controller
{
    private $userPoliticalPartyRepository;

    public function __construct(UserPoliticalPartyRepositoryInterface $userPoliticalPartyRepository)
    {
        $this->userPoliticalPartyRepository = $userPoliticalPartyRepository;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->userPoliticalPartyRepository->allUserPoliticalPartys();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserPoliticalPartyStoreRequest $request)
    {
        $this->userPoliticalPartyRepository->storeUserPoliticalParty($request->validated());
        return $this->userPoliticalPartyRepository->allUserPoliticalPartys();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserPoliticalPartyUpdateRequest $request, UserPoliticalParty $userPoliticalParty)
    {
        $this->userPoliticalPartyRepository->updateUserPoliticalParty($request->validated(), $userPoliticalParty);
        return $this->userPoliticalPartyRepository->allUserPoliticalPartys();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserPoliticalParty $userPoliticalParty)
    {
        $this->userPoliticalPartyRepository->destroyUserPoliticalParty($userPoliticalParty);
        return $this->userPoliticalPartyRepository->allUserPoliticalPartys();
    }
}
