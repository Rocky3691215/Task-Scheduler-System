<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Display the specified user.
     * @param mixed $id
     */
    public function show(User $user)
    {
        // $user = User::findOrFail($user);
        return view('users.show', compact('user'));
    }
}
