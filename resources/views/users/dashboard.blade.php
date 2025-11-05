@extends('layouts.master')

@section('title')
    My Dashboard
@endsection

@section('content')
<div class="container" style="max-width: 800px; margin: 0 auto; padding: 2rem;">
    <div class="profile-section" style="background: white; border-radius: 0.5rem; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h2 style="margin-bottom: 1.5rem; color: #1f2937;">My Profile</h2>
        
        <div class="profile-info" style="margin-bottom: 2rem;">
            <div style="margin-bottom: 1rem;">
                <strong>Name:</strong> {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
            </div>
            <div style="margin-bottom: 1rem;">
                <strong>Username:</strong> {{ auth()->user()->username }}
            </div>
            <div style="margin-bottom: 1rem;">
                <strong>Email:</strong> {{ auth()->user()->email }}
            </div>
        </div>

        <div class="actions" style="display: flex; gap: 1rem;">
            <a href="{{ route('users.edit', auth()->user()) }}" 
               style="background: #4f46e5; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; text-decoration: none;">
                Edit Profile
            </a>
            
            <form action="{{ route('users.destroy', auth()->user()) }}" method="POST" style="display: inline;"
                  onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        style="background: #ef4444; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; border: none; cursor: pointer;">
                    Delete Account
                </button>
            </form>
        </div>
    </div>

    <div class="password-section" style="background: white; border-radius: 0.5rem; padding: 2rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h2 style="margin-bottom: 1.5rem; color: #1f2937;">Change Password</h2>
        
        <form action="{{ route('users.password.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 1rem;">
                <label for="current_password" style="display: block; margin-bottom: 0.5rem; color: #4b5563;">Current Password</label>
                <input type="password" id="current_password" name="current_password" required
                       style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
            </div>

            <div style="margin-bottom: 1rem;">
                <label for="password" style="display: block; margin-bottom: 0.5rem; color: #4b5563;">New Password</label>
                <input type="password" id="password" name="password" required
                       style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label for="password_confirmation" style="display: block; margin-bottom: 0.5rem; color: #4b5563;">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                       style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
            </div>

            <button type="submit" 
                    style="background: #4f46e5; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; border: none; cursor: pointer;">
                Update Password
            </button>
        </form>
    </div>
</div>
@endsection