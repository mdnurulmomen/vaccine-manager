<?php

namespace App\Http\Controllers;

use App\Models\UserInterest;
use App\Http\Requests\UserInterestStoreRequest;
use App\Http\Requests\UserInterestUpdateRequest;
use App\Http\Interfaces\UserInterestRepositoryInterface;

class UserInterestController extends Controller
{
    private $userInterestRepository;

    public function __construct(UserInterestRepositoryInterface $userInterestRepository)
    {
        $this->userInterestRepository = $userInterestRepository;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->userInterestRepository->allUserInterests();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserInterestStoreRequest $request)
    {
        $this->userInterestRepository->storeUserInterest($request->validated());
        return $this->userInterestRepository->allUserInterests();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserInterestUpdateRequest $request, UserInterest $userInterest)
    {   
        $this->userInterestRepository->updateUserInterest($request->validated(), $userInterest);
        return $this->userInterestRepository->allUserInterests();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserInterest $userInterest)
    {
        $this->userInterestRepository->destroyUserInterest($userInterest);
        return $this->userInterestRepository->allUserInterests();
    }
}
