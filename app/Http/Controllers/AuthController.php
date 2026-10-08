<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(private AuthService $service)
    {

    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        if($this->service->register($data)){
            return response()->json(["message" => "verifique seu email"]);
        }

        return response()->json(["message" => "falha ao registrar usuário"], 422);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        
        if($this->service->login($data)){
            $request->session()->regenerate();
            return response()->json(["message" => "Logado com sucesso"]);
        }

        return response()->json(["message" => "erro ao logar", 422]);
    }

    public function verify(Request $request, int $id, string $hash)
    {
        if($this->service->verify($id, $hash)){
            $request->session()->regenerate();
            return response()->json(["message" => "conta verificada com sucesso!"]);
        }

        return response()->json(["message" => "não foi possivel verificar a conta"], 422);
    }
}