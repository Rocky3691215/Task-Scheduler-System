<?php
// ImageAttachmentController.php
namespace App\Http\Controllers;

use App\Models\ImageAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ImageAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $image_attachments = ImageAttachment::latest()->get();
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
            'image_file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
            'task_id' => 'nullable|integer|exists:tasks,id',
        ]);

        try {
            // Handle file upload
            if ($request->hasFile('image_file')) {
                $file = $request->file('image_file');
                $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
                $filePath = $file->storeAs('images', $fileName, 'public');
                
                $imageAttachment = ImageAttachment::create([
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => '/storage/' . $filePath,
                    'file_size' => $file->getSize(),
                    'upload_date' => now(),
                    'task_id' => $request->task_id,
                ]);

                return redirect()->route('image_attachments.index')
                    ->with('success', 'Image uploaded successfully.');
            }

            return back()->with('error', 'No file was uploaded.');

        } catch (\Exception $e) {
            Log::error('Image upload error: ' . $e->getMessage());
            return back()->with('error', 'Failed to upload image. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $attachment = ImageAttachment::findOrFail($id);
        return view('image_attachments.show', compact('attachment'));
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

        try {
            $image_attachment = ImageAttachment::findOrFail($id);
            $image_attachment->update($request->all());

            return redirect()->route('image_attachments.index')
                ->with('success', 'Image attachment updated successfully.');

        } catch (\Exception $e) {
            Log::error('Image update error: ' . $e->getMessage());
            return back()->with('error', 'Failed to update image attachment.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $image_attachment = ImageAttachment::findOrFail($id);
            
            // Delete physical file
            if (Storage::disk('public')->exists(str_replace('/storage/', '', $image_attachment->file_path))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $image_attachment->file_path));
            }
            
            $image_attachment->delete();

            return redirect()->route('image_attachments.index')
                ->with('success', 'Image attachment deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Image deletion error: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete image attachment.');
        }
    }
}