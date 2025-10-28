<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageAttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    \App\Models\ImageAttachment::create([
        'file_name' => 'test_image.png',
        'file_path' => 'storage/uploads/test_image.png',
        'file_size' => 512000,
        'upload_date' => now(),
        'task_id' => null,
    ]);
    }
}
