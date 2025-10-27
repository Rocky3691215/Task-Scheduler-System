@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h2>Account Sync Details</h2>
    <table class="table table-bordered">
        <tr>
            <th>Device ID</th>
            <td>{{ $accountSync->deviceId }}</td>
        </tr>
        <tr>
            <th>Last Sync Time</th>
            <td>{{ $accountSync->lastSyncTime }}</td>
        </tr>
        <tr>
            <th>User</th>
            <td>
                @if($accountSync->user)
                    {{ $accountSync->user->name ?? $accountSync->user->email }}
                @else
                    N/A
                @endif
            </td>
        </tr>
        <!-- Add more fields as needed -->
    </table>
    <a href="{{ route('account_sync.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection