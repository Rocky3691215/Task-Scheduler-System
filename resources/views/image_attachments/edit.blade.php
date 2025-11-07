@extends('layouts.master')

@section('title', 'Task Scheduler - Edit Image')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-4">
                <a href="{{ route('image_attachments.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0"><i class="fas fa-edit"></i> Edit Image Attachment</h4>
                </div>
                <div class="card-body">
                    <!-- Current Image Preview -->
                    <div class="text-center mb-4">
                        <img src="{{ $image_attachment->file_path }}" 
                             alt="{{ $image_attachment->file_name }}"
                             class="img-fluid rounded shadow"
                             style="max-height: 200px;"
                             onerror="this.src='https://via.placeholder.com/300x200?text=Image+Not+Found'">
                        <div class="mt-2">
                            <small class="text-muted">Current Image (Read-only)</small>
                        </div>
                    </div>

                    <form action="{{ route('image_attachments.update', $image_attachment->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="file_name" class="form-label fw-semibold">File Name</label>
                            <input type="text" class="form-control @error('file_name') is-invalid @enderror" 
                                   id="file_name" name="file_name" 
                                   value="{{ old('file_name', $image_attachment->file_name) }}" required>
                            @error('file_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="file_path" class="form-label fw-semibold">File Path</label>
                            <input type="text" class="form-control @error('file_path') is-invalid @enderror" 
                                   id="file_path" name="file_path" 
                                   value="{{ old('file_path', $image_attachment->file_path) }}" required>
                            @error('file_path')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="file_size" class="form-label fw-semibold">File Size (bytes)</label>
                                    <input type="number" class="form-control @error('file_size') is-invalid @enderror" 
                                           id="file_size" name="file_size" 
                                           value="{{ old('file_size', $image_attachment->file_size) }}">
                                    @error('file_size')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="upload_date" class="form-label fw-semibold">Upload Date</label>
                                    <input type="date" class="form-control @error('upload_date') is-invalid @enderror" 
                                           id="upload_date" name="upload_date" 
                                           value="{{ old('upload_date', $image_attachment->upload_date ? $image_attachment->upload_date->format('Y-m-d') : '') }}">
                                    @error('upload_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="task_id" class="form-label fw-semibold">Task ID</label>
                            <input type="number" class="form-control @error('task_id') is-invalid @enderror" 
                                   id="task_id" name="task_id" 
                                   value="{{ old('task_id', $image_attachment->task_id) }}"
                                   placeholder="Enter associated task ID">
                            @error('task_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('image_attachments.show', $image_attachment->id) }}" 
                               class="btn btn-outline-secondary me-md-2">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save"></i> Update Attachment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection