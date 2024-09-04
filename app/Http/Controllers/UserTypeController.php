<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\UserTypeRepositoryInterface;

class UserTypeController extends Controller
{
    private $userTypeRepository;

    public function __construct(UserTypeRepositoryInterface $userTypeRepository)
    {
        $this->userTypeRepository = $userTypeRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->userTypeRepository->allUserTypes();
    }
}
