@extends('layouts.master')

@section('title', 'Task Scheduler - Image Details')

@section('content')
<div class="container mt-4">
    <div class="mb-4">
        <a href="{{ route('image_attachments.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    @if($attachment)
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0"><i class="fas fa-image"></i> Image Attachment Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Image Preview -->
                <div class="col-md-6 text-center mb-4 mb-md-0">
                    <div class="border rounded p-3 bg-light">
                        <img src="{{ $attachment->file_path }}" 
                             alt="{{ $attachment->file_name }}"
                             class="img-fluid rounded shadow-sm"
                             style="max-height: 400px;"
                             onerror="this.src='https://via.placeholder.com/400x300?text=Image+Not+Found'">
                        <div class="mt-3">
                            <a href="{{ $attachment->file_path }}" 
                               target="_blank" 
                               class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-external-link-alt"></i> Open Original
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Details -->
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th class="bg-light" style="width: 30%;">ID</th>
                                    <td>
                                        <span class="badge bg-dark">#{{ $attachment->id }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">File Name</th>
                                    <td class="fw-semibold">{{ $attachment->file_name }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Storage Path</th>
                                    <td>
                                        <code class="text-break">{{ $attachment->file_path }}</code>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">File Size</th>
                                    <td>
                                        @if($attachment->file_size >= 1073741824)
                                            <span class="badge bg-primary">{{ number_format($attachment->file_size / 1073741824, 2) }} GB</span>
                                        @elseif($attachment->file_size >= 1048576)
                                            <span class="badge bg-info">{{ number_format($attachment->file_size / 1048576, 2) }} MB</span>
                                        @else
                                            <span class="badge bg-secondary">{{ number_format($attachment->file_size / 1024, 2) }} KB</span>
                                        @endif
                                        <small class="text-muted ms-2">({{ number_format($attachment->file_size) }} bytes)</small>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Upload Date</th>
                                    <td>
                                        <i class="fas fa-calendar text-muted me-1"></i>
                                        {{ $attachment->upload_date ? \Carbon\Carbon::parse($attachment->upload_date)->format('F d, Y') : 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Task ID</th>
                                    <td>
                                        @if($attachment->task_id)
                                            <span class="badge bg-success">Task #{{ $attachment->task_id }}</span>
                                        @else
                                            <span class="badge bg-light text-dark">Not assigned</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Created</th>
                                    <td>
                                        <i class="fas fa-clock text-muted me-1"></i>
                                        {{ $attachment->created_at->format('M d, Y g:i A') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Last Updated</th>
                                    <td>
                                        <i class="fas fa-sync text-muted me-1"></i>
                                        {{ $attachment->updated_at->format('M d, Y g:i A') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-4">
                        <a href="{{ route('image_attachments.edit', $attachment->id) }}" 
                           class="btn btn-warning me-md-2">
                            <i class="fas fa-edit"></i> Edit Details
                        </a>
                        <form action="{{ route('image_attachments.destroy', $attachment->id) }}" 
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this image? This action cannot be undone.')">
                                <i class="fas fa-trash"></i> Delete Image
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Not Found -->
    <div class="alert alert-warning text-center py-4">
        <i class="fas fa-exclamation-triangle fa-2x mb-3"></i>
        <h4>Attachment Not Found</h4>
        <p class="mb-0">The requested image attachment could not be found.</p>
    </div>
    @endif
</div>
@endsection