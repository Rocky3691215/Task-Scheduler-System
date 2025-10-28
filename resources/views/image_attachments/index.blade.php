@extends('layouts.master')

@section('title', 'Trackpay - Image Attachments')

@section('content')
<div class="container mt-4">

    <div class="mb-3">
        <a href="{{ route('image_attachments.create') }}" class="btn btn-secondary">Add New Image</a>
    </div>

    @if($image_attachments->count() > 0)
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
                    </tr>
                </thead>
                <tbody>
                    @foreach($image_attachments as $attachment)
                        <tr>
                            <td style="color:black;">
                                <a href="{{ route('image_attachments.show', $attachment->id) }}" style="color:black; text-decoration:none;">
                                    {{ $attachment->id }}
                                </a>
                            </td>
                            <td style="color:black;">{{ $attachment->file_name }}</td>
                            <td>
                                @if($attachment->file_path)
                                    <a href="{{ asset($attachment->file_path) }}" target="_blank" style="color:black; text-decoration:none;">
                                        View File
                                    </a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td style="color:black;">
                                @if($attachment->file_size)
                                    @if($attachment->file_size >= 1048576)
                                        {{ number_format($attachment->file_size / 1048576, 2) }} MB
                                    @else
                                        {{ number_format($attachment->file_size / 1024, 2) }} KB
                                    @endif
                                @else
                                    N/A
                                @endif
                            </td>
                            <td style="color:black;">
                                {{ $attachment->upload_date ? \Carbon\Carbon::parse($attachment->upload_date)->format('M d, Y') : 'N/A' }}
                            </td>
                            <td style="color:black;">{{ $attachment->task_id ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-warning text-center">No image attachments found.</div>
    @endif

</div>
@endsection


@push('styles')
<style>
    h2.text-primary {
        font-weight: 600;
        letter-spacing: 0.5px;
        
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

    table th, table td {
        padding: 12px 16px;
        vertical-align: middle !important;
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