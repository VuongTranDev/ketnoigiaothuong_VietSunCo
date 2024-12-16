<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\CompanyImageService;
use Illuminate\Http\Request;

class CompanyImageController extends BaseController
{
    public $service;

    public function __construct(CompanyImageService $service)
    {
        $this->service = $service;
    }

    public function createNew(Request $request)
    {
        $result = $this->service->createCompanyImage($request);
        if (!$result['status']) {
            return $this->failed('Create company image failed', 400, $result['errors']);
        }
        return $this->success($result['data'], 'Create company image success', 201);
    }
}
