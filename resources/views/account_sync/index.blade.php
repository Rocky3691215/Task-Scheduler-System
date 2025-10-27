@extends('layouts.master')

@section('title', 'Account Sync Status')



@push('navbar-override')
<style>
    /* Hide Account Sync button on its own page */
    a.nav-link[href="{{ url('/account_sync') }}"] {
        display: none !important;
    }
</style>
@endpush

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
body {
    font-family: 'Inter', sans-serif !important;
    background-color: #f8fafc !important;
    color: #1e293b !important;
    margin: 0 !important;
    padding: 0 !important;
}

main {
    min-height: calc(100vh - 140px) !important;
}

.page-container {
    max-width: 1200px !important;
    margin: 0 auto !important;
    padding: 2rem 2rem !important;
}

.page-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    border-radius: 16px !important;
    padding: 2rem !important;
    margin-bottom: 2rem !important;
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.15) !important;
    position: relative !important;
    overflow: hidden !important;
}

.page-header::before {
    content: '' !important;
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    bottom: 0 !important;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') !important;
    opacity: 0.3 !important;
}

.header-content {
    position: relative !important;
    z-index: 1 !important;
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    flex-wrap: wrap !important;
    gap: 1.5rem !important;
}

.page-title {
    color: white !important;
    font-size: 2.5rem !important;
    font-weight: 700 !important;
    margin: 0 !important;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
}

.page-subtitle {
    color: rgba(255, 255, 255, 0.9) !important;
    font-size: 1.1rem !important;
    font-weight: 400 !important;
    margin: 0.5rem 0 0 0 !important;
}

.add-button {
    background: rgba(255, 255, 255, 0.2) !important;
    backdrop-filter: blur(10px) !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    color: white !important;
    padding: 0.875rem 2rem !important;
    border-radius: 12px !important;
    text-decoration: none !important;
    font-weight: 600 !important;
    font-size: 1rem !important;
    transition: all 0.3s ease !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 0.5rem !important;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
}

.add-button:hover {
    background: rgba(255, 255, 255, 0.3) !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15) !important;
    color: white !important;
}

.add-button::before {
    content: '+' !important;
    font-size: 1.2rem !important;
    font-weight: 700 !important;
}

.content-card {
    background: white !important;
    border-radius: 16px !important;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05) !important;
    border: 1px solid #e2e8f0 !important;
    overflow: hidden !important;
}

.table-container {
    overflow-x: auto !important;
}

table {
    width: 100% !important;
    border-collapse: collapse !important;
    background-color: #ffffff !important;
}

th, td {
    padding: 1.25rem 1.5rem !important;
    text-align: left !important;
    border-bottom: 1px solid #f1f5f9 !important;
    font-size: 0.95rem !important;
    line-height: 1.5 !important;
}

th {
    background-color: #f8fafc !important;
    font-weight: 600 !important;
    color: #475569 !important;
    font-size: 0.875rem !important;
    text-transform: uppercase !important;
    letter-spacing: 0.05em !important;
    position: sticky !important;
    top: 0 !important;
    z-index: 10 !important;
}

tr:hover {
    background-color: #f8fafc !important;
}

tr:last-child td {
    border-bottom: none !important;
}

.action-link {
    color: #3b82f6 !important;
    text-decoration: none !important;
    font-weight: 500 !important;
    transition: all 0.2s ease !important;
    padding: 0.25rem 0.5rem !important;
    border-radius: 6px !important;
    margin: 0 0.25rem !important;
}

.action-link:hover {
    color: #1d4ed8 !important;
    background-color: #eff6ff !important;
}

.empty-state {
    text-align: center !important;
    padding: 4rem 2rem !important;
    color: #64748b !important;
}

.empty-state-icon {
    font-size: 3rem !important;
    margin-bottom: 1rem !important;
    opacity: 0.5 !important;
}

.empty-state-text {
    font-size: 1.1rem !important;
    margin-bottom: 0.5rem !important;
}

.empty-state-subtext {
    font-size: 0.95rem !important;
    color: #94a3b8 !important;
}

@media (max-width: 768px) {
    .page-container {
        padding: 1rem !important;
    }

    .page-header {
        padding: 2rem !important;
    }

    .header-content {
        flex-direction: column !important;
        text-align: center !important;
    }

    .page-title {
        font-size: 2rem !important;
    }

    th, td {
        padding: 1rem !important;
        font-size: 0.875rem !important;
    }
}
</style>
@endpush

@section('content')
    <div class="page-container">
        <!-- Professional Header Section -->
        <div class="page-header">
            <div class="header-content">
                <div>
                    <h1 class="page-title">Account Sync Status</h1>
                    <p class="page-subtitle">Manage and monitor your account synchronization across devices</p>
                </div>
                <a href="/account_sync/create" class="add-button">Add New Sync</a>
            </div>
        </div>

        <!-- Content Card -->
        <div class="content-card">
            <div class="table-container">
                <table>
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
                        @forelse ($accountSyncs as $sync)
                            <tr>
                                <td><a href="/account_sync/{{ $sync->syncId }}"><strong>{{ $sync->syncId }}</strong></a></td>
                                <td>
                                    @if($sync->lastSyncTime)
                                        <span style="color: #059669;">{{ \Carbon\Carbon::parse($sync->lastSyncTime)->format('M j, Y g:i A') }}</span>
                                    @else
                                        <span style="color: #dc2626;">Never</span>
                                    @endif
                                </td>
                                <td><code style="background: #f1f5f9; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.875rem;">{{ $sync->deviceId }}</code></td>
                                <td><strong>{{ $sync->userId }}</strong></td>
                                <td>{{ $sync->created_at->format('M j, Y g:i A') }}</td>
                                <td>{{ $sync->updated_at->format('M j, Y g:i A') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <div class="empty-state-icon">📱</div>
                                        <div class="empty-state-text">No account sync records found</div>
                                        <div class="empty-state-subtext">Get started by adding your first device sync</div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
