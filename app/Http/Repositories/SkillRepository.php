<?php

namespace App\Http\Repositories;

use App\Models\Skill;
use App\Http\Interfaces\SkillRepositoryInterface;

class SkillRepository implements SkillRepositoryInterface
{
    public function allSkills()
    {
        return Skill::latest()->paginate(10);
    }

    public function storeSkill($data)
    {
        return Skill::create($data);
    }

    public function updateSkill($data, Skill $skill)
    {
        $skill->update($data);
    }

    public function destroySkill(Skill $skill)
    {
        $skill->delete();
    }
}