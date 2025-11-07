@extends('layouts.master')

@section('title', 'Trackpay - Edit Image Attachment')

@section('content')
<div class="container mt-4">

    <div class="mb-3">
        <a href="{{ route('image_attachments.index') }}" class="btn btn-light" style="color:black; border:1px solid #ccc;">
            Back to List
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <h4>Edit Image Attachment</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('image_attachments.update', $image_attachment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="file_name" class="form-label">File Name</label>
                    <input type="text" class="form-control" id="file_name" name="file_name" value="{{ old('file_name', $image_attachment->file_name) }}" required>
                    @error('file_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="file_path" class="form-label">File Path</label>
                    <input type="text" class="form-control" id="file_path" name="file_path" value="{{ old('file_path', $image_attachment->file_path) }}" required>
                    @error('file_path')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="file_size" class="form-label">File Size (in bytes)</label>
                    <input type="number" class="form-control" id="file_size" name="file_size" value="{{ old('file_size', $image_attachment->file_size) }}" required>
                    @error('file_size')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="upload_date" class="form-label">Upload Date</label>
                    <input type="date" class="form-control" id="upload_date" name="upload_date" value="{{ old('upload_date', $image_attachment->upload_date) }}" required>
                    @error('upload_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="task_id" class="form-label">Task ID</label>
                    <input type="number" class="form-control" id="task_id" name="task_id" value="{{ old('task_id', $image_attachment->task_id) }}" required>
                    @error('task_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-warning">Update Attachment</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Spacing from the navigation bar */
    .container {
        margin-top: 80px !important;
    }

    .card {
        border-radius: 8px;
    }

    .card-header {
        border-radius: 8px 8px 0 0;
    }
</style>
@endpush
