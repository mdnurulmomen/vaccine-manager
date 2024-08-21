<?php
namespace App\Http\Interfaces;

use App\Models\Skill;

Interface SkillRepositoryInterface{
    public function allSkills();
    public function storeSkill($data);
    public function updateSkill($data, Skill $skill); 
    public function destroySkill(Skill $skill);
}