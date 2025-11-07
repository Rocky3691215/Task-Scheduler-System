@extends('layouts.master')

@section('title', 'Trackpay - Image Attachments')

@section('content')


<div class="container mt-8">

    <div class="mb-8">
        <a href="{{ route('image_attachments.create') }}" class="btn btn-secondary"> Image Files </a>
    </div>

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
                <tr>
                    <td style="color:black;">1</td>
                    <td style="color:black;">sample_image.png</td>
                    <td><a href="#" style="color:black; text-decoration:none;"> File</a></td>
                    <td style="color:black;">200.00 KB</td>
                    <td style="color:black;">Oct 28, 2025</td>
                    <td style="color:black;">11</td>
                </tr>
                <tr>
                    <td style="color:black;">2</td>
                    <td style="color:black;">project_logo.jpg</td>
                    <td><a href="#" style="color:black; text-decoration:none;">File</a></td>
                    <td style="color:black;">350.00 KB</td>
                    <td style="color:black;">Oct 30, 2025</td>
                    <td style="color:black;">12</td>
                </tr>
                <tr>
                    <td style="color:black;">3</td>
                    <td style="color:black;">invoice_receipt.pdf</td>
                    <td><a href="#" style="color:black; text-decoration:none;"> File</a></td>
                    <td style="color:black;">1.20 MB</td>
                    <td style="color:black;">Nov 01, 2025</td>
                    <td style="color:black;">8</td>
                </tr>
                <tr>
                    <td style="color:black;">4</td>
                    <td style="color:black;">meeting_notes.docx</td>
                    <td><a href="#" style="color:black; text-decoration:none;">File</a></td>
                    <td style="color:black;">500.00 KB</td>
                    <td style="color:black;">Nov 02, 2025</td>
                    <td style="color:black;">5</td>
                </tr>
                <tr>
                    <td style="color:black;">5</td>
                    <td style="color:black;">task_overview.xlsx</td>
                    <td><a href="#" style="color:black; text-decoration:none;">File</a></td>
                    <td style="color:black;">250.00 KB</td>
                    <td style="color:black;">Nov 03, 2025</td>
                    <td style="color:black;">7</td>
                </tr>
                <tr>
                    <td style="color:black;">6</td>
                    <td style="color:black;">bug_report.txt</td>
                    <td><a href="#" style="color:black; text-decoration:none;">File</a></td>
                    <td style="color:black;">100.00 KB</td>
                    <td style="color:black;">Nov 05, 2025</td>
                    <td style="color:black;">10</td>
                </tr>
            </tbody>
        </table>
    </div>
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
