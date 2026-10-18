<?php

namespace App\Http\Middleware;

use App\Models\Appointment;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAppointmentStakeholderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $appointment = $request->route('appointment');
        $isStakeholder = $appointment->user->id === $user->id || $appointment->barber->id === $user->id;
        if ($isStakeholder){
            return $next($request);
        }

        return response()->json(["message" => "você não é permitido de cancelar esse agendamento"], 403);
    }
}
