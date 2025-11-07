<?php

namespace App\Http\Controllers;

use App\Models\ImageAttachment;
use Illuminate\Http\Request;

class ImageAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $image_attachments = \App\Models\ImageAttachment::all();
    return view('image_attachments.index', compact('image_attachments'));
}



    /**
     * Display a specific image attachment.
     */
public function show($id)
{

  $attachments = [
        1 => [
            'id' => 1,
            'file_name' => 'sample_image.png',
            'file_path' => '#',
            'file_size' => 204800,
            'upload_date' => '2025-10-28',
            'task_id' => 11,
        ],
        2 => [
            'id' => 2,
            'file_name' => 'project_logo.jpg',
            'file_path' => '#',
            'file_size' => 358400,
            'upload_date' => '2025-10-30',
            'task_id' => 12,
        ],
        3 => [
            'id' => 3,
            'file_name' => 'invoice_receipt.pdf',
            'file_path' => '#',
            'file_size' => 1258291,
            'upload_date' => '2025-11-01',
            'task_id' => 8,
        ],
        4 => [
            'id' => 4,
            'file_name' => 'meeting_notes.docx',
            'file_path' => '#',
            'file_size' => 512000,
            'upload_date' => '2025-11-02',
            'task_id' => 5,
        ],
        5 => [
            'id' => 5,
            'file_name' => 'task_overview.xlsx',
            'file_path' => '#',
            'file_size' => 256000,
            'upload_date' => '2025-11-03',
            'task_id' => 7,
        ],
        6 => [
            'id' => 6,
            'file_name' => 'bug_report.txt',
            'file_path' => '#',
            'file_size' => 102400,
            'upload_date' => '2025-11-05',
            'task_id' => 10,
        ]
    ];

    
      $attachment = $attachments[$id] ?? null;

    return view('image_attachments.image_attachments_model', compact('attachment'));
}




}
