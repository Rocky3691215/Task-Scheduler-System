@extends('layouts.master')

@section('title', 'Edit Account Sync')

@push('styles')
<style>
    .auth-section a[href*="/home"],
    .auth-section a[href*="/account_sync"],
    .auth-section form {
                display: none !important;
    }
    .edit-container {
        max-width: 800px;
        margin: 3rem auto;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(149, 157, 165, 0.2);
        overflow: hidden;
    }

    .edit-header {
        padding: 1.5rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
    }

    .edit-header h1 {
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
    }

    .edit-form {
        padding: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        font-weight: 500;
        color: #475569;
        margin-bottom: 0.5rem;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 1rem;
        color: #1e293b;
    }

    .btn-container {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
    }

    .btn-primary {
        background-color: #667eea;
        color: #fff;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        border: none;
        cursor: pointer;
    }

    .btn-secondary {
        background-color: #64748b;
        color: #fff;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        border: none;
        cursor: pointer;
    }
</style>
@endpush

@section('content')
<div class="edit-container">
    <div class="edit-header">
        <h1>Edit Account Sync</h1>
    </div>

    @if ($errors->any())
        <div style="padding: 1.5rem; background-color: #fef2f2; color: #991b1b;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="edit-form" action="{{ route('account_sync.update', $accountSync->syncId) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="deviceId">Device ID</label>
            <input type="text" id="deviceId" name="deviceId" class="form-input" value="{{ old('deviceId', $accountSync->deviceId) }}">
        </div>

        <div class="form-group">
            <label for="lastSyncTime">Last Sync Time</label>
            <input type="datetime-local" id="lastSyncTime" name="lastSyncTime" class="form-input" value="{{ old('lastSyncTime', $accountSync->lastSyncTime ? \Carbon\Carbon::parse($accountSync->lastSyncTime)->format('Y-m-d\TH:i') : '') }}">
        </div>

        <div class="btn-container">
            <button type="submit" class="btn-primary">Update Sync</button>
            <a href="{{ route('account_sync.index') }}" class="btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
