@extends('layouts.master')

@section('title')
    Users
@endsection

@section('page')
    Users
@endsection

@section('addbtn')
    <div>
        <a class="add" href="">Add a User</a>
    </div>
@endsection

@section('content')
<div class="row">
    <form class="edit-form">
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="Placeholder" id="first_name" type="text" class="validate">
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="text" class="validate">
          <label for="last_name">Last Name</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" class="validate">
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" class="validate">
          <label for="password">Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="confirm password" type="confirm password" class="validate">
          <label for="confirm password">Confirm Password</label>
        </div>
      </div>
    </form>
  </div>
        
@endsection
