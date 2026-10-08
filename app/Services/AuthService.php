<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data)
    {
        $emailExists = User::where('email', $data['email'])->exists();
        if ($emailExists){
            return false;
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password_hash' => Hash::make($data['email']),
            'cellphone' => $data['cellphone'],
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}