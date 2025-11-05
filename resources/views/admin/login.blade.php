@extends('layouts.master')

@section('title')
    Admin Login
@endsection

@section('content')
<div class="container" style="max-width: 500px; margin: 2rem auto;">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title" style="text-align: center; width: 100%;">Admin Login</h2>
        </div>

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            @error('email')
                <div class="alert alert-error">{{ $message }}</div>
            @enderror
            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif
            
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" name="email" id="email" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" name="password" id="password" class="form-input" required>
            </div>

            <button type="submit" class="btn btn-primary btn-full">
                Login as Admin
            </button>
        </form>
    </div>
</div>
@endsection