@extends('layouts.master')

@section('title', 'Trackpay - Image Attachment Details')

@section('content')
<div class="container mt-4">

    <div class="mb-3">
        <a href="{{ route('image_attachments.index') }}" style="color:black; class="btn btn-secondary">Back to List</a>
    </div>

    @if($attachment)
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-bordered table-striped text-center align-middle">
                <tbody>
                    <tr>
                        <td style="color:black;">{{ $attachment->id }}</td>
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
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-warning text-center">Attachment not found.</div>
    @endif

</div>
@endsection
