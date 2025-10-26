<!DOCTYPE html>
<html>
<head>
    <title>Image Attachments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">Image Attachments</h2>

    <table class="table table-bordered table-hover">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>File Name</th>
                <th>File Path</th>
                <th>File Size (bytes)</th>
                <th>Upload Date</th>
                <th>Task ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attachments as $attachment)
                <tr class="text-center">
                    <td>{{ $attachment->id }}</td>
                    <td>{{ $attachment->file_name }}</td>
                    <td>{{ $attachment->file_path }}</td>
                    <td>{{ $attachment->file_size ?? 'N/A' }}</td>
                    <td>{{ $attachment->upload_date ?? 'N/A' }}</td>
                    <td>{{ $attachment->task_id ?? 'None' }}</td>
                    <td>
                        <a href="{{ asset($attachment->file_path) }}" target="_blank" class="btn btn-sm btn-primary">View</a>
                        <a href="#" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No image attachments found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>
