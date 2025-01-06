<?php

namespace App\Services;

use App\Models\User;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class AuthService
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:users,email',
        ]);
        if ($validator->fails()) {
            return [
                'status' => false,
                'errors' => $validator->errors()
            ];
        }
        $user = new Users();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = 1;
        $user->role_id = 2;
        $user->save();
        return [
            'status' => true,
            'data' => $user
        ];
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = Users::where('email', $request->email)->first();

        if ($user && $user->remember_token) {
            return [
                'message' => 'User is already logged in. Please logout first.',
                'status' => false,
                'errors' => 'User is already logged in. Please logout first.'
            ];
        }
        if (!Hash::check($request->password, $user->password)) {
            return [
                'message' => 'Unauthorized',
                'errors' => 'Sai email hoặc mật khẩu!!.',
                'status' => false
            ];
        }

        $token = $user->createToken('auth_token', ['*'], now()->addMinutes(120))->plainTextToken;
        $user->remember_token = $token;
        $user->save();

        return [
            'message' => 'Login success',
            'token' => $token,
            'role' => $user->roles->name,
            'status' => 'success'
        ];
    }

    public function changeStatusUser($id)
    {
        $currentUser = auth()->user();
        if ($currentUser->role->name !== 'admin') {
            return [
                'message' => 'Unauthorized: You do not have permission to change user status.',
                'status' => false
            ];
        }
        $user = Users::find($id);
        if (!$user) {
            return [
                'message' => 'User not found',
                'status' => false
            ];
        }
        $user->status = !$user->status;
        $user->save();
        return [
            'message' => 'Change status success',
            'data' => $user,
            'status' => true
        ];
    }
    public function logout(Request $request)
    {
        $user = $request->user();
        if ($user) {

            $user->remember_token = null;
            $request->user()->currentAccessToken()->delete();
            $user->save();
            return [
                'status' => 'success',
                'message' => 'Logged out successfully.'
            ];
        }
        return [
            'status' => 'error',
            'message' => 'Unable to logout. User not authenticated.'
        ];
    }


    
}
