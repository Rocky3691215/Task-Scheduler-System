@extends('layouts.master')

@section('title', 'Create Account Sync')

@push('navbar-override')
    <style>
        /* Hide the Home link in the auth-section */
        .main-header .auth-section a.nav-link[href="{{ url('/') }}"] {
            display: none !important;
        }
        /* Hide the Account Sync link in the auth-section */
        .main-header .auth-section a.nav-link[href="{{ url('/account_sync') }}"] {
            display: none !important;
        }
        /* Hide the Logout button in the auth-section */
        .main-header .auth-section .btn-logout {
            display: none !important;
        }
        /* Hide the nav-center section completely */
        .main-header .nav-center {
            display: none !important;
        }
    </style>
    <div class="auth-section" style="display: flex !important; margin-left: auto;">
        <a href="{{ route('account_sync.index') }}" class="btn-primary">Return</a>
    </div>
@endpush

@section('content')
    <div class="centered-message">
        <div class="alert alert-info text-center" role="alert">
            <h2>Feature Not Yet Implemented</h2>
            <p>We are still working on this feature. Please check back later!</p>
        </div>
    </div>
@endsection