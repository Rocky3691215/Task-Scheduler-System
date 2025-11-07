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
        $image_attachments = ImageAttachment::all();
        return view('image_attachments.index', compact('image_attachments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('image_attachments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file_name' => 'required|string|max:255',
            'file_path' => 'required|string|max:255',
            'file_size' => 'nullable|integer|min:0',
            'upload_date' => 'nullable|date',
            'task_id' => 'nullable|integer|exists:tasks,id',
        ]);

        ImageAttachment::create($request->all());

        return redirect()->route('image_attachments.index')->with('success', 'Image attachment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $attachment = ImageAttachment::findOrFail($id);
        return view('image_attachments.image_attachments_model', compact('attachment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $image_attachment = ImageAttachment::findOrFail($id);
        return view('image_attachments.edit', compact('image_attachment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'file_name' => 'required|string|max:255',
            'file_path' => 'required|string|max:255',
            'file_size' => 'nullable|integer|min:0',
            'upload_date' => 'nullable|date',
            'task_id' => 'nullable|integer|exists:tasks,id',
        ]);

        $image_attachment = ImageAttachment::findOrFail($id);
        $image_attachment->update($request->all());

        return redirect()->route('image_attachments.index')->with('success', 'Image attachment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $image_attachment = ImageAttachment::findOrFail($id);
        $image_attachment->delete();

        return redirect()->route('image_attachments.index')->with('success', 'Image attachment deleted successfully.');
    }
}
