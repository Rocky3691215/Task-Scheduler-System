@extends('layouts.master')

@section('title')
    Admin Dashboard
@endsection

@section('content')
<div class="container">
    <div class="card">
        <h2 class="card-title">Admin Details</h2>

        <div style="margin-top: 1rem;">
            <table style="width:100%; max-width:700px;">
                <tr>
                    <th style="text-align:left; padding:0.5rem; width:200px;">Name</th>
                    <td style="padding:0.5rem;">{{ trim((auth()->user()->first_name ?? '') . ' ' . (auth()->user()->last_name ?? '')) ?: auth()->user()->username ?? auth()->user()->email }}</td>
                </tr>
                <tr>
                    <th style="text-align:left; padding:0.5rem;">Username</th>
                    <td style="padding:0.5rem;">{{ auth()->user()->username ?? '-' }}</td>
                </tr>
                <tr>
                    <th style="text-align:left; padding:0.5rem;">Email</th>
                    <td style="padding:0.5rem;">{{ auth()->user()->email }}</td>
                </tr>
                <tr>
                    <th style="text-align:left; padding:0.5rem;">Role</th>
                    <td style="padding:0.5rem;">{{ ucfirst(auth()->user()->role ?? 'user') }}</td>
                </tr>
                <tr>
                    <th style="text-align:left; padding:0.5rem;">Member since</th>
                    <td style="padding:0.5rem;">{{ optional(auth()->user()->created_at)->format('Y-m-d') ?? '-' }}</td>
                </tr>
            </table>

            <div style="margin-top: 1rem; display:flex; gap:0.5rem;">
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Manage Users</a>
                <a href="{{ route('users.edit') }}" class="btn btn-secondary">Edit Profile</a>
            </div>
        </div>
    </div>
</div>
@endsection