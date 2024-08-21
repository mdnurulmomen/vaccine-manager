<?php

namespace App\Http\Repositories;

use App\Models\PoliticalParty;
use App\Http\Interfaces\PoliticalPartyRepositoryInterface;

class PoliticalPartyRepository implements PoliticalPartyRepositoryInterface
{
    public function allPoliticalParties()
    {
        return PoliticalParty::latest()->paginate(10);
    }

    public function storePoliticalParty($data)
    {
        return PoliticalParty::create($data);
    }

    public function updatePoliticalParty($data, PoliticalParty $politicalParty)
    {
        $politicalParty->update($data);
    }

    public function destroyPoliticalParty(PoliticalParty $politicalParty)
    {
        $politicalParty->delete();
    }
}