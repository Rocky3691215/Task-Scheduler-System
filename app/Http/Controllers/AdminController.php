<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->isAdmin()) {
                $request->session()->regenerate();
                // Always redirect admins to admin dashboard (do not use intended())
                return redirect()->route('admin.dashboard');
            }
            
            Auth::logout();
            return back()->with('error', 'You do not have admin privileges.');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function dashboard()
    {
        // Admin landing page (summary)
        return view('admin.dashboard');
    }

    /**
     * Show the users list (admin management)
     */
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function deleteUser(User $user)
    {
        // Prevent admin from deleting themselves
        if ($user->isAdmin() && $user->id === auth()->id()) {
            return back()->withErrors(['error' => 'You cannot delete your own admin account.']);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}