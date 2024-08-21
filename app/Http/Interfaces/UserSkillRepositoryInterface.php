<?php
namespace App\Http\Interfaces;

use App\Models\UserSkill;

Interface UserSkillRepositoryInterface{
    public function allSkills();
    public function storeSkill($data);
    public function updateSkill($data, UserSkill $userSkill); 
    public function destroySkill(UserSkill $userSkill);
}