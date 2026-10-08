<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(private AuthService $service)
    {

    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $this->service->register($data);
    }
}
