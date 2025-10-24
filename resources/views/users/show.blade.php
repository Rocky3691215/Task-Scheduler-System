@extends('layouts.master')

@section('title')
    Users
@endsection

@section('page')
    Users
@endsection



@section('table')
    <div class="table">
        <h5>{{ $user->first_name }}</h5>
        <h5>{{ $user->last_name }}</h5>
        <h5>{{ $user->username }}</h5>
        <h5>{{ $user->email }}</h5>
    </div>
@endsection
