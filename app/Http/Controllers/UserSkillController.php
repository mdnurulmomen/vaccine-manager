<?php

namespace App\Http\Controllers;

use App\Models\UserSkill;
use App\Http\Requests\UserSkillStoreRequest;
use App\Http\Requests\UserSkillUpdateRequest;
use App\Http\Interfaces\UserSkillRepositoryInterface;

class UserSkillController extends Controller
{
    private $userskillRepository;

    public function __construct(UserSkillRepositoryInterface $userskillRepository)
    {
        $this->userskillRepository = $userskillRepository;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->userskillRepository->allSkills();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserSkillStoreRequest $request)
    {
        $this->userskillRepository->storeSkill($request->validated());
        return $this->userskillRepository->allSkills();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserSkillUpdateRequest $request, UserSkill $userSkill)
    {
        $this->userskillRepository->updateSkill($request->validated(), $userSkill);
        return $this->userskillRepository->allSkills();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserSkill $userSkill)
    {
        $this->userskillRepository->destroySkill($userSkill);
        return $this->userskillRepository->allSkills();
    }
}
