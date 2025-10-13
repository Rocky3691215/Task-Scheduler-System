<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Attachments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Image Attachments</h2>

    {{-- Upload Form --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">Upload New Image</div>
        <div class="card-body">
            <form action="{{ route('image_attachments.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="image" class="form-label">Select Image:</label>
                    <input type="file" name="image" id="image" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Upload</button>
            </form>
        </div>
    </div>

    {{-- Display Uploaded Images --}}
    <div class="row">
        @forelse ($images as $image)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('storage/' . $image->file_path) }}" class="card-img-top" alt="{{ $image->file_name }}">
                    <div class="card-body text-center">
                        <p class="card-text">{{ $image->file_name }}</p>
                        <form action="{{ route('image_attachments.destroy', $image->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">No images uploaded yet.</p>
        @endforelse
    </div>
</div>

</body>
</html>
