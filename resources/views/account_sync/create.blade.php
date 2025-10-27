@extends('layouts.master')

@section('title', 'Create Account Sync')

@push('navbar-override')
<style>
    .main-header .auth-section .nav-link[href="{{ url('/') }}"] { /* Targeting the Home link */
        display: none !important;
    }

    .main-header .auth-section .btn-logout {
        display: none !important;
    }

    /* More specific targeting for the Account Sync link */
    a.nav-link[href="{{ url('/account_sync') }}"] {
        display: none !important;
    }

    .centered-message {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 80vh;
        flex-direction: column;
    }

    .return-button-container {
        position: absolute;
        top: 15px; /* Adjust as needed */
        right: 15px; /* Adjust as needed */
        z-index: 1000; /* Ensure it's above other elements */
    }
</style>
@endpush

@section('content')
<div class="centered-message">
    <div class="alert alert-info text-center" role="alert">
        <h2>Feature Not Yet Implemented</h2>
        <p>We are still working on this feature. Please check back later!</p>
        <a href="{{ route('account_sync.index') }}" class="btn btn-primary">Back to Account Sync List</a>
    </div>
</div>
<div class="return-button-container">
    <a href="{{ route('account_sync.index') }}" class="btn btn-primary">Return</a>
</div>
@endsection