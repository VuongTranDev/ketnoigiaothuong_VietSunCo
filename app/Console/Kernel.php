<?php

namespace App\Console;

use App\Models\Backup;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Lấy tất cả các lịch sao lưu từ bảng Backup
        $backupSchedules = Backup::all();
        foreach ($backupSchedules as $backupSchedule) {
            if ($backupSchedule->frequency === 'daily')
             {
                $schedule->command('backup:run --only-db')
                    ->dailyAt($backupSchedule->backup_time)
                    ->appendOutputTo(storage_path('logs/backup.log'));
            }
            elseif ($backupSchedule->frequency === 'weekly') {
                $schedule->command('backup:run --only-db')
                    ->weeklyOn(
                        array_search($backupSchedule->backup_day, ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']),
                        $backupSchedule->backup_time
                    )
                    ->appendOutputTo(storage_path('logs/backup.log'));
            }
            elseif ($backupSchedule->frequency === 'monthly') {
                $schedule->command('backup:run --only-db')
                    ->monthlyOn($backupSchedule->backup_day_of_month, $backupSchedule->backup_time)
                    ->appendOutputTo(storage_path('logs/backup.log'));
            }
        }
    }
    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
