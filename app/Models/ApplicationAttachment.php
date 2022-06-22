<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationAttachment extends Model
{
    const STORAGE_ATTACHMENTS_PATH = '/app/attachments';

    protected $fillable = ['application_id', 'storage_path', 'file_name', 'original_file_name'];
}
