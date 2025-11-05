@extends('layouts.master')

@section('title')
    Users
@endsection

@section('page')
    Users
@endsection



@section('table')
    <form class="edit-form">
        <label for="first_name">First Name :</label>
        <input type="text" name="first_name" value="{{ $user->first_name}}" readonly><br>

        <label for="last_name">Last Name :</label>
        <input type="text" name="last_name" value="{{ $user->last_name}}" readonly><br>

        <label for="username">Username :</label>
        <input type="text" name="username" value="{{ $user->username}}" readonly><br>

        <label for="email">Email :</label>
        <input type="text" name="email" value="{{ $user->email}}" readonly><br>
    </form>
@endsection
