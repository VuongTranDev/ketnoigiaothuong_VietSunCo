<?php

namespace App\Console\Commands;

use App\Mail\BackupNotificationMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Mail;

class CustomBackupCommand extends Command
{
    protected $signature = 'backup:run
                            {--only-db : Backup only the database}
                            {--routines : Include routines in the backup}
                            {--triggers : Include triggers in the backup}
                            {--filename= : Specify the filename for the backup}
                            {--only-to-disk= : Specify which disk to store the backup on}
                            ';
    protected $description = 'Backup the database including routines and triggers if specified';
    public function handle()
    {
        try {
            $mysqldumpPath = 'D:\\dowload\\Game_UD\\Mysql\\mysql-8.0.40-winx64\\bin\\mysqldump.exe'; // Đường dẫn đầy đủ
            Log::info($mysqldumpPath) ;
            // Kiểm tra các tùy chọn có được cung cấp không
            $includeRoutines = $this->option('routines');
            $includeTriggers = $this->option('triggers');
            $dbHost = env('DB_HOST', '127.0.0.1');
            $dbName = env('DB_DATABASE');
            $dbUser = env('DB_USERNAME');
            $dbPassword = env('DB_PASSWORD');

            $command = "{$mysqldumpPath} -h {$dbHost} -u {$dbUser} {$dbName}";
            Log::info("Command: " . $command);

            if ($includeRoutines) {
                $command .= ' --routines';
            }
            if ($includeTriggers) {
                $command .= ' --triggers';
            }

            // Tạo tên tệp backup hoặc sử dụng tên tùy chỉnh
            $filename = $this->option('filename') ?? storage_path('app/backup') . '/' . $dbName . '_backup_' . date('Y-m-d_H-i-s') . '.sql';
            exec($command . " > {$filename}", $output, $returnVar);
            if ($returnVar !== 0) {
                $this->error('Backup failed: ' . implode("\n", $output));
                return;
            }
            Log::info("Backup created successfully at: {$filename}");

            // Xác định đường dẫn Desktop phù hợp với hệ điều hành
            // if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            //     // Windows
            //     $desktopPath = getenv('USERPROFILE') . '\\Desktop';
            // } else {
            //     // Linux/Mac
            //     $desktopPath = '/home/' . get_current_user() . '/Desktop';
            // }
            //   $this->info("Desktop path: " . $desktopPath);
            //
           ;
            // Debug thông báo kiểm tra đường dẫn
            // Tạo tệp zip backup
            $zipBackupFile = storage_path('app/backup') . DIRECTORY_SEPARATOR . $dbName . '_backup_' . date('Y-m-d_H-i-s') . '.zip';
            Log::info("Zip backup file: " . $zipBackupFile);

            $zipCommand = "7z a {$zipBackupFile} {$filename}";
            exec($zipCommand, $zipOutput, $zipReturnVar);

            if ($zipReturnVar !== 0) {
                $this->error('Compression failed: ' . implode("\n", $zipOutput));
                return;
            }

            unlink($filename);
            $this->info("Backup created successfully at: {$zipBackupFile}");
            $this->sendBackupNotification('success', $zipBackupFile);

        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            $this->sendBackupNotification('failed', $e->getMessage());
        }
    }

    protected function sendBackupNotification($isSuccessful, $zipBackupFile = null)
    {
        // Lấy thông tin sao lưu từ hệ thống
        $backupPath = storage_path('app/backup');
        $backupFiles = File::files($backupPath);
        $newestBackupFile = collect($backupFiles)
            ->filter(function ($file) {
                // Kiểm tra xem file có đuôi .zip hay không
                return strtolower(pathinfo($file, PATHINFO_EXTENSION)) === 'zip';
            })
            ->sortByDesc(function ($file) {
                // Sắp xếp các file theo thời gian sửa đổi mới nhất
                return File::lastModified($file);
            })
            ->first();

        $newestBackupSize = File::size($newestBackupFile) / 1024;
        $numberOfBackups = count($backupFiles);
        $totalStorageUsed = collect($backupFiles)->sum(function ($file) {
            return File::size($file);
        }) / 1024 / 1024;
        $newestBackupDate = date('Y/m/d H:i:s', File::lastModified($newestBackupFile));
        $oldestBackupDate = date('Y/m/d H:i:s', File::lastModified($backupFiles[0])); // Ngày sao lưu cũ nhất

        $details = [
            'backup_name' => 'Laravel',
            'disk' => 'local',
            'newest_backup_size' => number_format($newestBackupSize, 2), // Định dạng kích thước sao lưu
            'number_of_backups' => $numberOfBackups,
            'total_storage_used' => number_format($totalStorageUsed, 2),
            'newest_backup_date' => $newestBackupDate,
            'oldest_backup_date' => $oldestBackupDate,
        ];

        $mail = new BackupNotificationMail(
            $isSuccessful ? 'Backup successful' : 'Backup failed',
            $details
        );

        // Chỉ đính kèm nếu có file zip
        if ($zipBackupFile) {
            $mail->attach($zipBackupFile);
        }

        Mail::to('hoankien140703@gmail.com')->send($mail);
    }
}
