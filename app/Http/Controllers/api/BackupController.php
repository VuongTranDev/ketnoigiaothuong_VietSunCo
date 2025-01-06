<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\BackupService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Backup\Exceptions\BackupFailed;

class BackupController extends BaseController
{
    protected $backupService;
    public function __construct(BackupService $backupupService)
    {
        $this->backupService = $backupupService;
    }

    public function backup()
    {
        try {
            $result = $this->backupService->backup();
            if ($result === 0)
                return $this->success([], 'Backup successfully', 200);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return $this->failed($e->getMessage(), 401, []);
        }
    }

    public function backupSchedule(Request $request)
    {
        $validate = $this->backupService->validateData($request);
        if ($validate->fails())
            return $this->failed($validate->errors(), 400, []);
        try {
            $result = $this->backupService->scheduleBackup($request);
            return $this->success($result,  'Create backup schedule successfully', 200);
        } catch (Exception $e) {
            Log::info("Error :" . $e->getMessage());
            return $this->failed('Create backup schedule  unsuccessfully!', 401);
        }
    }

    public function showListBackup()
    {
        $data  = $this->backupService->showListBackup();
        Log::info("message" . $data);
        if ($data == null) {
            $this->failed('Error', 404);
        }
        return $this->success($data, 'List backup schedule', 200);
    }

    public function removeschedule($id)
    {
        try {
            $this->backupService->removeSchedules($id);
            return $this->success([], 'Backup schedule deleted successfully', 200);
        } catch (Exception $e) {
            return $this->failed('Backup schedule not found', 404);
        } catch (\Exception $e) {
            return $this->exception('Error occurred', $e->getMessage(), 500);
        }
    }


    public function removeAllSchedule()
    {
        try {
            $this->backupService->removeAllSchedule();
            return $this->success([], 'Backup schedule deleted successfully', 200);
        } catch (Exception $e) {
            return $this->failed('Backup schedule not found', 404);
        } catch (\Exception $e) {
            return $this->exception('Error occurred', $e->getMessage(), 500);
        }
    }

    public function restore(Request $request)
    {
        try {
            $file = $request->file('backup_file');
            Log::info($file) ;
            if (!$file) {
                return $this->failed('This file not accept', 400, []);
            }
            $result = $this->backupService->restore($request);
            if ($result == 1001)
                return $this->failed('This not file sql', 404, []);
            else if ($result == 1002)
                return $this->failed('This file dont exist', 404, []);
            else if ($result == null)
                return $this->failed('Error occurred during restore process.', 403, []);
            else
                return $this->success([], 'Database restored successfully!.', 200);
        } catch (Exception $e) {
            return $this->failed($e->getMessage(), 403, []);
        }
    }
}
