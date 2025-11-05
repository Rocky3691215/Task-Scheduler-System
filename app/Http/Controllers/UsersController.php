<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Display the specified user.
     * @param mixed $id
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);
        return view('users.user_model', compact('user'));
    }
    public function create()
    {
        $this->authorize('create', User::class);
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return redirect()->route('users.show', $user)->with('success', 'Account created.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user = null)
    {
        $user = $user ?? auth()->user();
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, User $user = null)
    {
        $user = $user ?? auth()->user();
        $this->authorize('update', $user);

        $data = $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'username' => 'sometimes|required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'sometimes|required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.dashboard')->with('success', 'Account updated.');
    }

    /**
     * Remove the specified user from storage.
     */
    /**
     * Update user's password.
     */
    public function updatePassword(Request $request, User $user = null)
    {
        $user = $user ?? auth()->user();
        $this->authorize('update', $user);

        $data = $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($data['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($data['password'])
        ]);

        return back()->with('success', 'Password updated successfully.');
    }

    public function destroy(User $user = null)
    {
        $user = $user ?? auth()->user();
        $this->authorize('delete', $user);

        // Prevent admin from deleting themselves
        if ($user->isAdmin() && $user->id === auth()->id()) {
            return back()->withErrors(['error' => 'You cannot delete your own admin account.']);
        }

        $user->delete();

        return redirect('/')->with('success', 'User deleted.');
    }
}
