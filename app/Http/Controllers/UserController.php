<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

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

    /**
     * Search User resource.
     */
    public function search(Request $request)
    {
        $validated = $request->validate([
            'nid' => 'required|string|max:255|exists:users,nid'
        ]);

        $user = $this->userRepository->searchUserNID($validated);

        return redirect('/')->with('user', $user);
    }
}
