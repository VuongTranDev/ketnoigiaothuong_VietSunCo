<?php

namespace App\Services;

use App\Models\Backup;
use Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BackupService
{

    public function backup()
    {
        $output = Artisan::call('backup:run'
        , [
             '--only-db' => true,
            // '--routines' => true,
            // '--triggers' => true,
        ]);
        return $output;
    }

    public function validateData($request)
    {
        return Validator::make($request->all(), [
            'backup_frequency' => 'required|in:daily,weekly,monthly',
            'backup_time' => 'required',
            'backup_day' => 'nullable|required_if:backup_frequency,weekly',
            'backup_day_of_month' => 'nullable|required_if:backup_frequency,monthly|integer|min:1|max:31',
        ]);
    }
    public function scheduleBackup(Request $request)
    {
        $schedule = new Backup();
        $schedule->frequency = $request->backup_frequency;
        $schedule->backup_time = $request->backup_time;
        $schedule->backup_day = $request->backup_day;
        $schedule->backup_day_of_month = $request->backup_day_of_month;
        $schedule->save();
        return $schedule;
    }

    public function showListBackup()
    {
        return Backup::all();
    }

    public function removeSchedules($id)
    {
        $backup = Backup::findOrFail($id);
        $backup->delete();
        return $backup;
    }

    public function removeAllSchedule()
    {
        return  Backup::truncate() ;
    }
}
