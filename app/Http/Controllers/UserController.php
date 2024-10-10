<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->userRepository->allUsers();
    }

    /**
     * Display a listing of the resource.
     */
    public function allUnscheduledUsers()
    {
        return $this->userRepository->allUnscheduledUsers();
    }
}
