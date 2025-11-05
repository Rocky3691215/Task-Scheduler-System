@extends('layouts.master')

@section('title')
    Edit User
@endsection

@section('page')
    Edit User
@endsection

@section('content')
<div class="row">
    <form method="POST" action="{{ route('users.update', $user) }}" class="edit-form">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="input-field col s6">
                <input id="first_name" name="first_name" type="text" value="{{ old('first_name', $user->first_name ?? '') }}" required>
                <label for="first_name">First Name</label>
            </div>
            <div class="input-field col s6">
                <input id="last_name" name="last_name" type="text" value="{{ old('last_name', $user->last_name ?? '') }}" required>
                <label for="last_name">Last Name</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input id="username" name="username" type="text" value="{{ old('username', $user->username ?? '') }}" required>
                <label for="username">Username</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input id="email" name="email" type="email" value="{{ old('email', $user->email ?? '') }}" required>
                <label for="email">Email</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input id="password" name="password" type="password" class="validate">
                <label for="password">New Password (leave blank to keep current)</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input id="password_confirmation" name="password_confirmation" type="password" class="validate">
                <label for="password_confirmation">Confirm New Password</label>
            </div>
        </div>

        <div class="row mt-2">
            <button class="btn btn-primary" type="submit">Save</button>
            <a href="{{ route('users.dashboard') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
