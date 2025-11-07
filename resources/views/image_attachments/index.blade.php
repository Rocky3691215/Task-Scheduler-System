@extends('layouts.master')

@section('title', 'Task Scheduler - Image Attachments')

@section('content')
<div class="container mt-4">
    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1"><i class="fas fa-images"></i> Image Attachments</h2>
            <p class="text-muted mb-0">Manage your uploaded images and attachments</p>
        </div>
        <a href="{{ route('image_attachments.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Upload New Image
        </a>
    </div>

    <!-- Table -->
    <div class="card shadow-sm">
        <div class="card-body">
            @if($image_attachments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Preview</th>
                                <th>File Name</th>
                                <th>Size</th>
                                <th>Upload Date</th>
                                <th>Task ID</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($image_attachments as $attachment)
                            <tr>
                                <td class="fw-semibold">#{{ $attachment->id }}</td>
                                <td>
                                    <img src="{{ $attachment->file_path }}" 
                                         alt="{{ $attachment->file_name }}"
                                         class="rounded" 
                                         style="width: 50px; height: 50px; object-fit: cover; border: 1px solid #dee2e6;"
                                         onerror="this.src='https://via.placeholder.com/50?text=Image+Not+Found'">
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ \Illuminate\Support\Str::limit($attachment->file_name, 30) }}</div>
                                    <small class="text-muted">{{ $attachment->file_path }}</small>
                                </td>
                                <td>
                                    @if($attachment->file_size >= 1048576)
                                        <span class="badge bg-info">{{ number_format($attachment->file_size / 1048576, 1) }} MB</span>
                                    @else
                                        <span class="badge bg-secondary">{{ number_format($attachment->file_size / 1024, 1) }} KB</span>
                                    @endif
                                </td>
                                <td>
                                    <i class="fas fa-calendar text-muted me-1"></i>
                                    {{ $attachment->upload_date ? \Carbon\Carbon::parse($attachment->upload_date)->format('M d, Y') : 'N/A' }}
                                </td>
                                <td>
                                    @if($attachment->task_id)
                                        <span class="badge bg-primary">#{{ $attachment->task_id }}</span>
                                    @else
                                        <span class="badge bg-light text-dark">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('image_attachments.show', $attachment->id) }}" 
                                           class="btn btn-outline-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('image_attachments.edit', $attachment->id) }}" 
                                           class="btn btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('image_attachments.destroy', $attachment->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-outline-danger" 
                                                    title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this image? This action cannot be undone.')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Results Count -->
                <div class="mt-3 text-muted">
                    <small>Showing {{ $image_attachments->count() }} image(s)</small>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-images fa-4x text-muted"></i>
                    </div>
                    <h4 class="text-muted">No images found</h4>
                    <p class="text-muted mb-4">Get started by uploading your first image attachment.</p>
                    <a href="{{ route('image_attachments.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus"></i> Upload Your First Image
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table th {
        border-bottom: 2px solid #4f46e5;
    }
    .btn-group .btn {
        border-radius: 4px;
        margin: 0 2px;
    }
    .badge {
        font-size: 0.75em;
    }
</style>
@endpush