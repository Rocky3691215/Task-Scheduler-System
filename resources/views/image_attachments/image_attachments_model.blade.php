@extends('layouts.master')

@section('title', 'Trackpay - Image Attachment Details')

@section('content')
<div class="container mt-4">

    <div class="mb-3">
        <a href="{{ route('image_attachments.index') }}" class="btn btn-light" style="color:black; border:1px solid #ccc;">
            Back to List
        </a>
    </div>

    @if($attachment)
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-bordered table-striped text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>File Name</th>
                        <th>File Path</th>
                        <th>File Size</th>
                        <th>Upload Date</th>
                        <th>Task ID</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="color:black;">{{ $attachment['id'] }}</td>
                        <td style="color:black;">{{ $attachment['file_name'] }}</td>
                        <td><a href="{{ $attachment['file_path'] }}" style="color:black; text-decoration:none;">View File</a></td>
                        <td style="color:black;">
                            @if($attachment['file_size'] >= 1048576)
                                {{ number_format($attachment['file_size'] / 1048576, 2) }} MB
                            @else
                                {{ number_format($attachment['file_size'] / 1024, 2) }} KB
                            @endif
                        </td>
                        <td style="color:black;">{{ \Carbon\Carbon::parse($attachment['upload_date'])->format('M d, Y') }}</td>
                        <td style="color:black;">{{ $attachment['task_id'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-warning text-center">Attachment not found.</div>
    @endif

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

