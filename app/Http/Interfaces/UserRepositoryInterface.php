<?php
namespace App\Http\Interfaces;

use App\Models\Skill;

Interface UserRepositoryInterface{
    public function index();
    public function unscheduledUserIndex();
    public function searchUserNID($data);
}
