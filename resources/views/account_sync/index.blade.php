{{-- I will assume you have a layout file at layouts.app --}}
{{-- If not, you can create one or use a simple HTML structure --}}

{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}
<div class="container">
    <h1>Account Sync Status</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Sync ID</th>
                <th>Last Sync Time</th>
                <th>Device ID</th>
                <th>User ID</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            {{-- You would loop through your account sync data here --}}
            {{-- Example: --}}
            {{-- @foreach ($accountSyncs as $sync)
                <tr>
                    <td>{{ $sync->syncId }}</td>
                    <td>{{ $sync->lastSyncTime }}</td>
                    <td>{{ $sync->deviceId }}</td>
                    <td>{{ $sync->userId }}</td>
                    <td>{{ $sync->created_at }}</td>
                    <td>{{ $sync->updated_at }}</td>
                </tr>
            @endforeach --}}
        </tbody>
    </table>
</div>
{{-- @endsection --}}