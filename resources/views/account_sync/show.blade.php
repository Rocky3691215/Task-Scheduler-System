@extends('layouts.master')

@section('title', 'Account Sync Details')

@push('navbar-override')
    <style>
        .nav-center, .auth-section {
            display: none !important;
        }
    </style>
@endpush

@section('content')
    <div class="page-container">
        <!-- Professional Header Section -->
        <div class="page-header">
            <div class="header-content">
                <div>
                    <h1 class="page-title">Account Sync Details</h1>
                    <p class="page-subtitle">Detailed information for Account Sync ID: {{ $accountSync->id }}</p>
                </div>
                <a href="{{ route('account_sync.index') }}" class="add-button">Return</a>
            </div>
        </div>

        <!-- Content Card -->
        <div class="content-card">
            <div class="table-container">
                <table>
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td><strong>{{ $accountSync->id }}</strong></td>
                        </tr>
                        <tr>
                            <th>User ID</th>
                            <td><code style="background: #f1f5f9; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.875rem;">{{ $accountSync->user_id }}</code></td>
                        </tr>
                        <tr>
                            <th>Last Sync Time</th>
                            <td>
                                @if($accountSync->lastSyncTime)
                                    <span style="color: #059669;">{{ \Carbon\Carbon::parse($accountSync->lastSyncTime)->format('M j, Y g:i A') }}</span>
                                @else
                                    <span style="color: #dc2626;">Never</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Platform</th>
                            <td>{{ $accountSync->platform }}</td>
                        </tr>
                        <tr>
                            <th>Access Token</th>
                            <td>{{ $accountSync->access_token }}</td>
                        </tr>
                        <tr>
                            <th>Refresh Token</th>
                            <td>{{ $accountSync->refresh_token }}</td>
                        </tr>
                        <tr>
                            <th>Expires At</th>
                            <td>{{ $accountSync->expires_at }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $accountSync->created_at->format('M j, Y g:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $accountSync->updated_at->format('M j, Y g:i A') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection