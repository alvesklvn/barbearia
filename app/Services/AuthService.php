<?php

namespace App\Services;

use App\Jobs\SendEmailVerificationJob;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use JsonException;

class AuthService
{
    public const DUMMY_HASH = "\$2y\$12\$E0FwX8v5zIX.k0370F2Ywu9xjQ2V7SQNUYOWv/azO.qKdUqnicEH2";

    public function register(array $data)
    {
        $emailExists = User::where('email', $data['email'])->exists();
        if ($emailExists){
            return false;
        }

        try{
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password_hash' => Hash::make($data['password']),
                'cellphone' => $data['cellphone']
            ]);        

            SendEmailVerificationJob::dispatch($user)->onQueue('emails');

            return true;
        } catch (\Throwable $e){
            throw new JsonException("erro: ".$e->getMessage());
            return false;
        }
    }

    public function login(array $data)
    {
        $user = User::where('email', $data['email'])->whereNotNull('email_verified_at')->first();

        if(!$user){
            $hashed = $user->password_hash;
        } else {
            $hashed = self::DUMMY_HASH;   
        }

        $isCorrectPassword = Hash::check($data['password'], $hashed);

        if (!$isCorrectPassword || !$user){
            return false;
        }

        Auth::login($user);
        return true;
    }

    public function verify(int $id, string $hash)
    {
        $user = User::whereNull('email_verified_at')->findOrFail($id);

        if(!$user){
            return false;
        }

        if (!hash_equals(sha1($user->getEmailForVerification()), $hash)){
            return false;
        }

        try{
            $user->markEmailAsVerified();
            Auth::login($user);
            return true;
        } catch(\Throwable $e){
            return false;
        }
    }
}