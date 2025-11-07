@extends('layouts.master')

@section('title', 'Selective Sync')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
body {
    font-family: 'Inter', sans-serif;
    background-color: #f8fafc;
    color: #1e293b;
}

.container {
    max-width: 600px;
    margin: 4rem auto;
    padding: 2rem;
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
}

h1 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

p {
    color: #64748b;
    margin-bottom: 2rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

label {
    display: block;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.checkbox-group label {
    display: flex;
    align-items: center;
    padding: 1rem;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.checkbox-group label:hover {
    background-color: #f8fafc;
    border-color: #cbd5e1;
}

.checkbox-group input[type="checkbox"] {
    margin-right: 1rem;
    height: 1.25rem;
    width: 1.25rem;
}

.btn-submit {
    display: inline-block;
    width: 100%;
    padding: 1rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
}
</style>
@endpush

@section('content')
<div class="container">
    <h1>Selective Sync</h1>
    <p>Choose which data you want to synchronize across your devices.</p>

    <form action="{{ route('account_sync.save_selective_sync') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Sync Options</label>
            <div class="checkbox-group">
                <label>
                    <input type="checkbox" name="sync_options[]" value="profile">
                    User Profile
                </label>
                <br>
                <label>
                    <input type="checkbox" name="sync_options[]" value="settings">
                    Application Settings
                </label>
                <br>
                <label>
                    <input type="checkbox" name="sync_options[]" value="tasks">
                    Tasks
                </label>
            </div>
            @error('sync_options')
                <div style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn-submit" style="flex: 1;">Sync Selected Data</button>
            <a href="{{ route('account_sync.index') }}" class="btn-submit" style="flex: 1; text-align: center; background: #64748b; text-decoration: none;">Cancel</a>
        </div>
    </form>
</div>
@endsection
