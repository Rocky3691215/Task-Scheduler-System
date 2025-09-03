<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignUpsController extends Controller
{
    public function index()
    {
        return view('sign-up');
    }
}
