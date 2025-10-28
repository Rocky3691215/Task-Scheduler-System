<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageAttachment extends Model
{
    use HasFactory;

    protected $table = 'image_attachments'; // matches your table name
    protected $fillable = [
        'file_name',
        'file_path',
        'file_size',
        'upload_date',
        'task_id',
    ];
}
