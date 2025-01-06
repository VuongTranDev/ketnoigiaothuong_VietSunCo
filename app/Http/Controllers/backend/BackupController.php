<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BackupController extends Controller
{
    protected $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        return view('frontend.admin.backup-restore');
    }

    public function backup()
    {
        $url = config('api.base_url') . "backupDB";
        $response = $this->client->request(
            'POST',
            $url,
            [
                'form_params' => []
            ]
        );
        if ($response->getStatusCode() == 200) {
            return redirect()->route('admin.backup.index')->with('success', 'Backup successfully!');
        } else {
            return redirect()->route('admin.backup.index')->with('error', 'Backup unsuccessfully!');
        }
    }

    public function backupSchedule(Request $request)
    {
        try {
            $data = $request->only('backup_frequency', 'backup_time', 'backup_day', 'backup_day_of_month');
            $url = config('api.base_url') . "backup";
            $response = $this->client->request(
                'POST',
                $url,
                [
                    'form_params' => $data
                ]
            );
            if ($response->getStatusCode() == 200) {
                return redirect()->route('admin.backup.index')->with('success', 'Insert backup schedule successfully!');
            } else {
                return redirect()->route('admin.backup.index')->with('error', 'Insert backup schedule unsuccessfully!');
            }
        } catch (Exception $e) {
            Log::info("message" . $e->getMessage());
            return redirect()->route('admin.backup.index')->with('error', 'Insert backup schedule unsuccessfully!');
        }
    }

    public function restore(Request $request)
    {
        try {
            $data = $request->file('backup_file');
            $url = config('api.base_url') . "restore";
            $response = $this->client->request(
                'POST',
                $url,
                [
                    'multipart' => [
                    [
                        'name'     => 'backup_file', // Tên trường input trong API
                        'contents' => fopen($data->getRealPath(), 'r'),
                        'filename' => $data->getClientOriginalName() // Tên tệp gốc
                    ]
                ]
                ]
            );
            if ($response->getStatusCode() == 200) {
            Log::info($data) ;
                return redirect()->route('admin.backup.index')->with('success', 'Restore database successfully!');
            } else if ($response->getStatusCode() == 404) {
                return redirect()->route('admin.backup.index')->with('error', 'This file dont exist!');
            } else if ($response->getStatusCode() == 403) {
                return redirect()->route('admin.backup.index')->with('error', 'Error occurred during restore process!');
            } else if ($response->getStatusCode() == 400) {
                return redirect()->route('admin.backup.index')->with('error', 'This file not accept!');
            }
        } catch (Exception $e) {
            return redirect()->route('admin.backup.index')->with('error', $e->getMessage());
        }
    }
}
