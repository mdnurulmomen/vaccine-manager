<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use App\Http\Interfaces\InterestRepositoryInterface;
use App\Http\Requests\InterestStoreRequest;
use App\Http\Requests\InterestUpdateRequest;

class InterestController extends Controller
{
    private $interestRepository;

    public function __construct(InterestRepositoryInterface $interestRepository)
    {
        $this->interestRepository = $interestRepository;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->interestRepository->allInterests();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InterestStoreRequest $request)
    {
        $this->interestRepository->storeInterest($request->validated());
        return $this->interestRepository->allInterests();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InterestUpdateRequest $request, Interest $interest)
    {
        $this->interestRepository->updateInterest($request->validated(), $interest);
        return $this->interestRepository->allInterests();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interest $interest)
    {
        $this->interestRepository->destroyInterest($interest);
        return $this->interestRepository->allInterests();
    }
}
