@extends('layouts.master')

@section('title', 'Account Sync Details')

@push('styles')
<style>
    .details-container {
        max-width: 800px;
        margin: 3rem auto;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(149, 157, 165, 0.2);
        overflow: hidden;
    }

    .details-header {
        padding: 1.5rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
    }

    .details-header h1 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #fff;
        margin: 0;
    }

    .details-header p {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.9);
        margin: 0.25rem 0 0 0;
    }

    .details-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
        padding: 1.5rem;
    }

    .detail-item {
        background-color: #f8fafc;
        padding: 1rem;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
    }

    .detail-item strong {
        display: block;
        font-weight: 500;
        color: #475569;
        margin-bottom: 0.25rem;
    }

    .detail-item span {
        font-size: 1rem;
        color: #1e2d3b;
    }

    .history-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1.5rem;
    }

    .history-table th, .history-table td {
        padding: 0.75rem 1rem;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
    }

    .history-table th {
        background-color: #f8fafc;
        font-weight: 600;
        color: #475569;
    }

    .status-badge {
        display: inline-block;
        padding: 0.25em 0.6em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.375rem;
    }

    .status-badge-success {
        color: #166534;
        background-color: #dcfce7;
    }

    .status-badge-failed {
        color: #991b1b;
        background-color: #fee2e2;
    }

    .status-badge-pending {
        color: #9a3412;
        background-color: #ffedd5;
    }

    .no-history {
        padding: 1.5rem;
        text-align: center;
        color: #64748b;
    }
</style>
@endpush

@section('content')
<div class="details-container">
    <div class="details-header">
        <h1>Account Sync Details</h1>
        @if (Auth::user()->email === 'admin@user.com')
            <p>Information details of User ID: {{ $accountSync->user_account_id }}</p>
        @endif
    </div>

    <div class="details-grid">
        @if (Auth::user()->email === 'admin@user.com')
        <div class="detail-item">
            <strong>User Account ID</strong>
            <span>{{ $accountSync->user_account_id }}</span>
        </div>
        @endif
        <div class="detail-item">
            <strong>Device ID</strong>
            <span>{{ $accountSync->deviceId }}</span>
        </div>
        <div class="detail-item">
            <strong>Last Sync Time</strong>
            <span>{{ $accountSync->lastSyncTime }}</span>
        </div>
        <div class="detail-item">
            <strong>Created At</strong>
            <span>{{ $accountSync->created_at }}</span>
        </div>
        <div class="detail-item">
            <strong>Updated At</strong>
            <span>{{ $accountSync->updated_at }}</span>
        </div>
    </div>

    @if($accountSync->history->isNotEmpty())
    <div class="details-grid">
        <h2 style="margin-bottom: 1rem; font-size: 1.25rem; font-weight: 600; color: #334155;">Sync History</h2>
            <table class="history-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accountSync->history as $record)
                        <tr>
                            <td>{{ $record->created_at->format('M d, Y H:i:s') }}</td>
                            <td>
                                <span class="status-badge status-badge-{{ strtolower($record->status) }}">
                                    {{ ucfirst($record->status) }}
                                </span>
                            </td>
                            <td>{{ $record->message }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
    @endif
</div>
@endsection
