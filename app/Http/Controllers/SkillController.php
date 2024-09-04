<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Http\Requests\SkillStoreRequest;
use App\Http\Requests\SkillUpdateRequest;
use App\Http\Interfaces\SkillRepositoryInterface;

class SkillController extends Controller
{
    private $skillRepository;

    public function __construct(SkillRepositoryInterface $skillRepository)
    {
        $this->skillRepository = $skillRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->skillRepository->allSkills();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SkillStoreRequest $request)
    {
        $this->skillRepository->storeSkill($request->validated());
        return $this->skillRepository->allSkills();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SkillUpdateRequest $request, Skill $skill)
    {
        $this->skillRepository->updateSkill($request->validated(), $skill);
        return $this->skillRepository->allSkills();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        $this->skillRepository->destroySkill($skill);
        return $this->skillRepository->allSkills();
    }
}
