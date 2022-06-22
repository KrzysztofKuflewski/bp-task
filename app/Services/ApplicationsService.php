<?php


namespace App\Services;


use App\Models\Application;
use App\Models\ApplicationAttachment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApplicationsService
{

    public function createApplication(array $data): ?Application
    {
        DB::beginTransaction();

        try {
            $application = Application::create(
                [
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                ]
            );

            if (count($data['attachments']) > 0) {
                foreach ($data['attachments'] as $attachment) {
                    $original_file_name = $attachment->getClientOriginalName();
                    $file_name = time() . '_' . $original_file_name;
                    $attachments_storage_path = ApplicationAttachment::STORAGE_ATTACHMENTS_PATH . '/' . $application->id;
                    $attachment->move(storage_path() . $attachments_storage_path, $file_name);

                    ApplicationAttachment::create(
                        [
                            'application_id' => $application->id,
                            'storage_path' => $attachments_storage_path,
                            'file_name' => $file_name,
                            'original_file_name' => $original_file_name,
                        ]
                    );
                }
            }

            DB::commit();

            return $application;
        } catch (\Throwable $e) {
            Log::alert($e->getMessage());
            DB::rollback();
            throw $e;
        }
    }
}
