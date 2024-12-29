<?php

namespace App\Services;

use App\Models\Users;
use Hash;
use Laravel\Socialite\Facades\Socialite;
use User;

class GoogleService
{

    public function getGoogleSignInUrl()
    {
        $url = Socialite::driver('google')->redirect()->getTargetUrl();
        return $url;
    }

    public function loginCallback()
    {
        \Log::info("Attempting to fetch Google user.");

        // Thêm log trước khi gọi Socialite
        \Log::info("Starting Socialite user fetch...");
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = Users::where('google_id', $googleUser->id)->first();
        \Log::info(' User:'. $user);  // Log thông tin người dùng trả về
        if ($user)
        {
            $token = $user->createToken('auth_token')->plainTextToken;
            $user->remember_token = $token;
            $user->save() ;
            return $user;
        }
        // Tạo người dùng mới
        $user = Users::create([
            'email' => $googleUser->email,
            'name' => $googleUser->name,
            'google_id' => $googleUser->id,
            'status' => true,
            'role_id' => 1,
            'password' => Hash::make('123'), // Mã hóa mật khẩu
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;
        $user->remember_token = $token;
        $user->save() ;
        return $user;
    }
}
