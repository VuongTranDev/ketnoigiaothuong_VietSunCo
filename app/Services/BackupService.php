<?php

namespace App\Services;

use App\Models\Backup;
use Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BackupService
{

    public function backup()
    {
        $output = Artisan::call('backup:run');
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
        return  Backup::truncate();
    }


    public function restore(Request $request)
    {
        $file = $request->file('backup_file');
        $path = $file->storeAs('backup', $file->getClientOriginalName());
        // Kiểm tra xem tệp có phải là file nén không (ví dụ: .zip)
        $fileExtension = $file->getClientOriginalExtension();
        $extractPath = storage_path('app' . DIRECTORY_SEPARATOR . 'backup' . DIRECTORY_SEPARATOR . 'extracted');
        if (!file_exists($extractPath)) {
            mkdir($extractPath, 0777, true); // Tạo thư mục nếu không tồn tại
        }
        $zip = new \ZipArchive();
        $pathToExtractedFile = '';
        if (in_array($fileExtension, ['zip', 'tar', 'gz'])) {
            // Giải nén tệp nếu là file nén
            if ($fileExtension === 'zip' && $zip->open(storage_path('app' . DIRECTORY_SEPARATOR . $path)) === TRUE) {
                $zip->extractTo($extractPath);
                $zip->close();
                // Kiểm tra thư mục sau khi giải nén
            } elseif ($fileExtension === 'tar') {
                $phar = new \PharData(storage_path('app' . DIRECTORY_SEPARATOR . $path));
                $phar->extractTo($extractPath);
            }
        }
        $extractedFiles = glob($extractPath . DIRECTORY_SEPARATOR . '*.sql');
        // Kiểm tra xem có file .sql không
        if (empty($extractedFiles)) {
            return 1001;
            // không phải sql
        }

        // Chọn file SQL đầu tiên (nếu có nhiều hơn một file .sql)
        $pathToExtractedFile = $extractedFiles[0];

        // Kiểm tra xem file SQL có tồn tại sau khi giải nén không
        if (!file_exists($pathToExtractedFile)) {
            return 1002; // file sql k ton tai
        }

        // Đọc nội dung tệp SQL
        $sqlContent = file_get_contents($pathToExtractedFile);
        if (!$sqlContent) {
            return 1003; // file rỗng
        }
        $dbName = env('DB_DATABASE'); // Lấy tên database từ file .env
        $dbUser = env('DB_USERNAME'); // Lấy username từ file .env
        $dbHost = env('DB_HOST'); // Lấy host từ file .env

        DB::statement("DROP DATABASE IF EXISTS {$dbName}");
        DB::statement("CREATE DATABASE {$dbName}");
        $command = "mysql -v -u {$dbUser} --default-character-set=utf8mb4 {$dbName} < {$pathToExtractedFile}";
        exec($command, $output, $status);
        unlink($pathToExtractedFile);
        return $output;
    }
}
