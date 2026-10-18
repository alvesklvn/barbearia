<?php

namespace App\Http\Middleware;

use App\Models\Barber;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsBarberMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $isBarber = Barber::where('user_id', $user->id)->exists();
        if ($isBarber){
            return $next($request);
        }

        return response()->json(["message" => "você não é um barbeiro"], 403);
    }
}
