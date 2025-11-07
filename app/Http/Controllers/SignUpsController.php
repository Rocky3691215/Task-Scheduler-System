<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SignUpsController extends Controller
{
    /**
     * READ: Display the sign-up form.
     */
    public function index()
    {
        return view('sign-up');
    }

    /**
     * CREATE: Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:user_accounts',
            'email' => 'required|string|email|max:255|unique:user_accounts',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = UserAccount::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        Auth::login($user);

        return redirect('/home');
    }
}
