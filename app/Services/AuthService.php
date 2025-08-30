<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data): User {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => $data['role'] ?? 'user',
        ]);
        Auth::login($user, true);
        return $user;
    }

    public function attemptLogin(string $email, string $password, bool $remember = false): bool {
        return Auth::attempt(['email'=>$email,'password'=>$password], $remember);
    }

    public function logout(): void {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
}
