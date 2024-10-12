<?php
namespace App\Http\Interfaces;

Interface UserRepositoryInterface{
    public function index();
    public function unscheduledUserIndex();
    public function searchUserNID($data);
}
