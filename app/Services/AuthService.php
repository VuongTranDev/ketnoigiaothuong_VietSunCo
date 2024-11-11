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
        Log::info('Register user: ' . $request->email);
        $validator = Validator::make($request->all(), [
            'password' => 'required|string',
            'email' => 'required|email|unique:Users,email',
        ]);

        if ($validator->fails()) {
            return [
                'status' => false,
                'errors' => $validator->errors()
            ];
        }
        $user = new Users();
        $user->email = $request->email;
        $user->password = $request->password;
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
            $user->currentAccessToken()->delete();
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
