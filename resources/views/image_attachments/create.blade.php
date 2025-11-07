@extends('layouts.master')

@section('title', 'Task Scheduler - Upload Image')

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
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-upload"></i> Upload New Image</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('image_attachments.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="image_file" class="form-label fw-semibold">Select Image</label>
                            <input type="file" class="form-control @error('image_file') is-invalid @enderror" 
                                   id="image_file" name="image_file" accept="image/*" required>
                            <div class="form-text">
                                Supported formats: JPEG, PNG, JPG, GIF, WEBP. Max size: 5MB
                            </div>
                            @error('image_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="task_id" class="form-label fw-semibold">Task ID (Optional)</label>
                            <input type="number" class="form-control @error('task_id') is-invalid @enderror" 
                                   id="task_id" name="task_id" value="{{ old('task_id') }}" 
                                   placeholder="Enter associated task ID">
                            @error('task_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="reset" class="btn btn-outline-secondary me-md-2">
                                <i class="fas fa-redo"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload"></i> Upload Image
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Image Preview -->
            <div class="card mt-4 d-none" id="previewCard">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-eye"></i> Image Preview</h5>
                </div>
                <div class="card-body text-center">
                    <img id="imagePreview" src="#" alt="Preview" class="img-fluid rounded" style="max-height: 300px; display: none;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('image_file').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('imagePreview');
        const previewCard = document.getElementById('previewCard');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                previewCard.classList.remove('d-none');
            }
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
            previewCard.classList.add('d-none');
        }
    });
</script>
@endpush