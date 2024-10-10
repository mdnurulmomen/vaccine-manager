<?php
namespace App\Http\Interfaces;

use App\Models\UserVaccine;

Interface UserVaccineRepositoryInterface{
    public function allUserVaccines();
    public function storeUserVaccine($data);
    public function updateUserVaccine($data, UserVaccine $userVaccine);
    public function destroyUserVaccine(UserVaccine $userVaccine);
}
