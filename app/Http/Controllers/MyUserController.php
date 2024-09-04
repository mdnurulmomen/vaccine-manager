<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\MyUserRepositoryInterface;

class MyUserController extends Controller
{
    private $myUserRepository;

    public function __construct(MyUserRepositoryInterface $myUserRepository)
    {
        $this->myUserRepository = $myUserRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->myUserRepository->myAllUsers();
    }
}
