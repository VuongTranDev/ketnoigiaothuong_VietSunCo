<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backup Data KET NOI GIAO THUONG</title>
</head>
<body>
    <h1 style="text-align:center">{{ $status }}</h1>

    <p><strong>Backup Name:</strong> {{ $details['backup_name'] }}</p>
    <p><strong>Disk:</strong> {{ $details['disk'] }}</p>
    <p><strong>Newest Backup Size:</strong> {{ $details['newest_backup_size'] }} KB</p>
    <p><strong>Number of Backups:</strong> {{ $details['number_of_backups'] }}</p>
    <p><strong>Total Storage Used:</strong> {{ $details['total_storage_used'] }} MB</p>
    <p><strong>Newest Backup Date:</strong> {{ $details['newest_backup_date'] }}</p>
    <p><strong>Oldest Backup Date:</strong> {{ $details['oldest_backup_date'] }}</p>

    <p>Regards, <br> KET NOI GIAO THUONG System</p>
</body>
</html>
