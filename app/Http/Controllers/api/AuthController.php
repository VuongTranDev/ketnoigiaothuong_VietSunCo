<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\BaseController;
use App\Services\AuthService;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends BaseController
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function register(Request $request)
    {
        $result = $this->authService->register($request);
        if (!$result['status']) {
            return $this->failed('Register failed', $result['errors'], 400);
        }
        return $this->success($result['data'], 'Register success', 201);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = Users::where('email', $request->email)->first();

        if ($user && $user->remember_token) {
            return response()->json([
                'message' => 'User is already logged in. Please logout first.',
                'status' => false
            ], 403);
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Unauthorized',
                'errors' => 'The provided credentials are incorrect.',
                'status' => false
            ], 401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        $user->remember_token = $token;
        $user->save();
        return response()->json([
            'message' => 'Login success',
            'token' => $token,
            'status' => 'success'
        ], 200);
    }

    public function getInfo(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        $result = $this->authService->logout($request);

        if (!$result['status']) {
            return $this->failed($result['message'], [], 403);
        }
        return $this->success([], $result['message']);
    }
    public function changeStatusUser($id)
    {
        $result = $this->authService->changeStatusUser($id);
        if (!$result['status']) {
            return $this->failed('Change status failed', $result['errors'], 400);
        }
        return $this->success($result['data'], 'Change status success', 200);
    }
}
