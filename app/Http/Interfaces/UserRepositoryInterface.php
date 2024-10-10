<?php
namespace App\Http\Interfaces;

use App\Models\Skill;

Interface UserRepositoryInterface{
    public function allUsers();
    public function allUnscheduledUsers();
}
