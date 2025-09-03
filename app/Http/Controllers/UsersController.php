<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsersController extends Controller
{
    /**
     * Display a listing of the users.
     * This method will retrieve all users and pass them to a view.
     */
    public function index(): View
    {
        // Get all users from the 'users' table using the User model
        $users = User::all();

        // Pass the users to the 'users.index' view
        return view('users.index', compact('users'));
    }

    /**
     * Display the specified user's profile.
     * @param int $id The user ID
     */
    public function show(string $id): View
    {
        // Find the user by their ID
        $user = User::findOrFail($id);

        // Pass the user data to the 'users.show' view
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create(): View
    {
        return view('users.create');
    }
}
