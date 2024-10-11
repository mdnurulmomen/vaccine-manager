<?php
namespace App\Http\Interfaces;

use App\Models\UserVaccine;

Interface UserVaccineRepositoryInterface{
    public function index();
    public function store($data);
    public function update($data, UserVaccine $userVaccine);
    public function destroy(UserVaccine $userVaccine);
}
