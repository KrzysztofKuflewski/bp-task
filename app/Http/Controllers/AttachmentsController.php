<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Http\Requests\StoreApplicationRequest;
use App\Models\ApplicationAttachment;
use App\Services\ApplicationsService;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class AttachmentsController extends Controller
{
    public function serve(int $attachment_id)
    {
        $attachment = ApplicationAttachment::findOrFail($attachment_id);
        $file_path = storage_path() . $attachment->storage_path . '/' . $attachment->file_name;

        return response()->file($file_path);
    }

}
