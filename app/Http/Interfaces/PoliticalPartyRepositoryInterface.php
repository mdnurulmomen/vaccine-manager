<?php
namespace App\Http\Interfaces;

use App\Models\PoliticalParty;

Interface PoliticalPartyRepositoryInterface{
    public function allPoliticalParties();
    public function storePoliticalParty($data);
    public function updatePoliticalParty($data, PoliticalParty $politicalParty); 
    public function destroyPoliticalParty(PoliticalParty $politicalParty);
}