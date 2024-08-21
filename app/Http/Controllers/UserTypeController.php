<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use App\Http\Requests\UserTypeStoreRequest;
use App\Http\Requests\UserTypeUpdateRequest;
use App\Http\Interfaces\UserTypeRepositoryInterface;

class UserTypeController extends Controller
{
    private $userTypeRepository;

    public function __construct(UserTypeRepositoryInterface $userTypeRepository)
    {
        $this->userTypeRepository = $userTypeRepository;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->userTypeRepository->allUserTypes();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserTypeStoreRequest $request)
    {
        $this->userTypeRepository->storeUserType($request->validated());
        return $this->userTypeRepository->allUserTypes();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserTypeUpdateRequest $request, UserType $userType)
    {
        $this->userTypeRepository->updateUserType($request->validated(), $userType);
        return $this->userTypeRepository->allUserTypes();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserType $userType)
    {
        $this->userTypeRepository->destroyUserType($userType);
        return $this->userTypeRepository->allUserTypes();
    }
}
