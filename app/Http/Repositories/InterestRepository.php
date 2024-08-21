<?php

namespace App\Http\Repositories;

use App\Models\Interest;
use App\Http\Interfaces\InterestRepositoryInterface;

class InterestRepository implements InterestRepositoryInterface
{

    public function allInterests()
    {
        return Interest::latest()->paginate(10);
    }

    public function storeInterest($data)
    {
        return Interest::create($data);
    }

    public function updateInterest($data, Interest $interest)
    {
        $interest->update($data);
    }

    public function destroyInterest(Interest $interest)
    {
        $interest->delete();
    }
}