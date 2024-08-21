<?php

namespace App\Http\Controllers;

use App\Models\PoliticalParty;
use App\Http\Requests\PoliticalPartyStoreRequest;
use App\Http\Requests\PoliticalPartyUpdateRequest;
use App\Http\Interfaces\PoliticalPartyRepositoryInterface;

class PoliticalPartyController extends Controller
{
    private $politicalPartyRepository;

    public function __construct(PoliticalPartyRepositoryInterface $politicalPartyRepository)
    {
        $this->politicalPartyRepository = $politicalPartyRepository;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->politicalPartyRepository->allPoliticalParties();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PoliticalPartyStoreRequest $request)
    {
        $this->politicalPartyRepository->storePoliticalParty($request->validated());
        return $this->politicalPartyRepository->allPoliticalParties();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PoliticalPartyUpdateRequest $request, PoliticalParty $politicalParty)
    {
        $this->politicalPartyRepository->updatePoliticalParty($request->validated(), $politicalParty);
        return $this->politicalPartyRepository->allPoliticalParties();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PoliticalParty $politicalParty)
    {
        $this->politicalPartyRepository->destroyPoliticalParty($politicalParty);
        return $this->politicalPartyRepository->allPoliticalParties();
    }
}
