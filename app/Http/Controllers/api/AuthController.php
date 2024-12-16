<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\BaseController;
use App\Services\AuthService;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Socialite;

class AuthController extends BaseController
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        $result =  $this->authService->register($request);
        if (!$result['status']) {
            return $this->failed('Register failed',  400, $result['errors']);
        }
        return $this->success($result['data'], 'Đăng kí thành công', 200);
    }



    public function login(Request $request)
    {
        $result =  $this->authService->login($request);
        if ($result['status'] == false) {
            return $this->failed('Login failed',  400, $result['errors']);
        }
        return $this->success([$result['token'],$result['role']], $request['message'], 200);
    }

    public function getInfo(Request $request)
    {
        $user = Users::with('roles')->find($request->user()->id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
                'status' => 'error'
            ], 404);
        }
        $formattedData = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'status' => $user->status,
            'roles' => $user->roles
        ];

        return $this->success($formattedData, 'Get info user success', 200);
    }


    public function logout(Request $request)
    {
        try {
            $user = $request->user();

            if ($user) {
                $request->user()->currentAccessToken()->delete();
                $user->remember_token = null;
                $user->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Đăng xuất thành công.'
                ], 200);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Không thể đăng xuất. Người dùng không xác thực.'
            ], 401);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi trong quá trình đăng xuất: ' . $e->getMessage()
            ], 500);
        }
    }

    public function changeStatusUser($id)
    {
        $result = $this->authService->changeStatusUser($id);
        if (!$result['status']) {
            return $this->failed('Change status failed',  400, $result['errors']);
        }
        return $this->success($result['data'], 'Change status success', 200);
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            Log::info('Attempting to authenticate Google user.');
            $user = Users::updateOrCreate(
                ['email' => $request->email],
                [
                    'google_id' => $request->google_id,
                    'email' => $request->email,
                    'role_id' => 2,
                    'status'=>1
                ]
            );
            Log::info('Attempting to authenticate Google user. '. json_encode($user));

            $token = $user->createToken('auth_token')->plainTextToken;
            $user->remember_token = $token;
            $user->save();
            return response()->json([
                'status' => 'success',
                'token' => $token,
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            Log::error('Error during Google callback: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to authenticate: ' . $e->getMessage(),
            ], 500);
        }
    }
}
