@extends('layouts.master')

@section('title', 'Trackpay - Image Attachments')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container mt-8">

    <div class="mb-8">
        <a href="{{ route('image_attachments.create') }}" class="btn btn-secondary"> Image File </a>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>File Name</th>
                    <th>File Path</th>
                    <th>File Size</th>
                    <th>Upload Date</th>
                    <th>Task ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($image_attachments as $attachment)
                <tr>
                    <td style="color:black;">{{ $attachment->id }}</td>
                    <td style="color:black;">{{ $attachment->file_name }}</td>
                    <td><a href="{{ $attachment->file_path }}" style="color:black; text-decoration:none;" target="_blank">File</a></td>
                    <td style="color:black;">{{ number_format($attachment->file_size / 1024, 2) }} KB</td>
                    <td style="color:black;">{{ $attachment->upload_date ? \Carbon\Carbon::parse($attachment->upload_date)->format('M d, Y') : 'N/A' }}</td>
                    <td style="color:black;">{{ $attachment->task_id ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('image_attachments.show', $attachment->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('image_attachments.edit', $attachment->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('image_attachments.destroy', $attachment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this attachment?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No image attachments found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Spacing from the navigation bar */
    .container {
        margin-top: 80px !important;
    }

    .btn-secondary {
        background-color: #e9ecef;
        color: #000;
        border: none;
        transition: all 0.2s ease;
    }

    .btn-secondary:hover {
        background-color: #d6d8db;
        color: #000;
    }

    table th,
    table td {
        padding: 12px 16px;
        vertical-align: middle !important;
        color: black;
    }

    table th {
        text-align: center;
        font-weight: 600;
        background-color: #0d6efd !important;
        color: #fff !important;
    }

    table tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    table tr:hover {
        background-color: #e9f3ff;
    }

    .table-responsive {
        border-radius: 8px;
        overflow: hidden;
    }
</style>
@endpush
