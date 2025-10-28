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
    $attachment = ImageAttachment::findOrFail($id);
    return view('image_attachments.image_attachments_model', compact('attachment'));
}




}
