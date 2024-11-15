<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Services\GoogleService;
use Hash;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends BaseController
{
    /**
     * Display a listing of the resource.
     */

    protected $googleService;

    // Inject GoogleService vào constructor
    public function __construct(GoogleService $googleService)
    {
        $this->googleService = $googleService;
    }
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getGoogleSignInUrl()
    {
        try {
            $url = $this->googleService->getGoogleSignInUrl();
            return $this->success($url, "success", 200);
        } catch (\Exception $e) {
            return $this->exception("Google sign in failed", $e->getMessage(), 400);
        }
    }


    public function loginCallback(Request $request)
    {
        try
        {

            // Log khi bắt đầu hàm
            \Log::info("loginCallback started");
            // Gọi service để lấy user từ Google
            $user = $this->googleService->loginCallback();
            return $this->success($user, "Đăng nhập thành công", 200);
        } catch (\Exception $exception) {
            // Log thông tin lỗi nếu có
            \Log::error("Exception in loginCallback", [
                'message' => $exception->getMessage(),
                'stack' => $exception->getTraceAsString(),
            ]);
            return $this->exception("Đăng nhập thất bại", $exception->getMessage(), 400);
        }
    }
}
