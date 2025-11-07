<?php
// ImageAttachment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageAttachment extends Model
{
    use HasFactory;

    protected $table = 'image_attachments';
    
    protected $fillable = [
        'file_name',
        'file_path',
        'file_size',
        'upload_date',
        'task_id',
    ];

    protected $casts = [
        'upload_date' => 'date',
        'file_size' => 'integer',
    ];

    /**
     * Get the task that owns the image attachment.
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}