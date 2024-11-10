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
            return $this->failed('Register failed', 400, $result['errors']);
        }
        return $this->success($result['data'], 'Register success', 201);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        Log::info("auth". json_encode($request->all()));
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }
        $user = Users::where('email', $request->email)->first();

        Log::info("user ". json_encode($user->password));

        if (!$user || !password_verify($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials',
                'errors' => [
                    'email' => ['The provided credentials are incorrect.'],
                ],
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        $user->remember_token = $token; // Optional: store the token
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Login success',
            'token' => $token,
        ],201);
    }

    public function getInfo(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        $result = $this->authService->logout($request);

        if (!$result['status']) {
            return $this->failed($result['message'], 403, []);
        }
        return $this->success([], $result['message']);
    }
    public function changeStatusUser($id)
    {
        $result = $this->authService->changeStatusUser($id);
        if (!$result['status']) {
            return $this->failed('Change status failed',  400, $result['errors']);
        }
        return $this->success($result['data'], 'Change status success', 200);

    }
}
