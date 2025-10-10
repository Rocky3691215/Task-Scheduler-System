<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

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
     * @param string $id The user ID
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

    /**
     * Store a newly created user in the database.
     * @param Request $request The incoming HTTP request
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        
        // Hash the password before creating the user
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create a new user with the validated data
        $user = User::create($validatedData);

        // Redirect to the user's profile page
        return redirect()->route('users.show', ['user' => $user->id])
                         ->with('success', 'User created successfully!');
    }

    /**
     * Show the form for editing the specified user.
     * @param string $id The user ID
     */
    public function edit(string $id): View
    {
        // Find the user by their ID
        $user = User::findOrFail($id);

        // Pass the user data to the 'users.edit' view
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in the database.
     * @param Request $request The incoming HTTP request
     * @param string $id The user ID
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        // Find the user by their ID
        $user = User::findOrFail($id);

        // Validate the request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        // Check if the password field is present and not an empty string
        if ($request->has('password') && $request->password !== null) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            // Unset the password field so it doesn't try to update a null value
            unset($validatedData['password']);
        }

        // Update the user with the validated data
        $user->update($validatedData);

        // Redirect to the user's profile page
        return redirect()->route('users.show', ['user' => $user->id])
                         ->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user from the database.
     * @param string $id The user ID
     */
    public function destroy(string $id): RedirectResponse
    {
        // Find the user by their ID and delete it
        User::findOrFail($id)->delete();

        // Redirect back to the user index page
        return redirect()->route('users.index')
                         ->with('success', 'User deleted successfully!');
    }
}
