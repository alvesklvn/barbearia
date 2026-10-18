<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Barber;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class AppointmentService
{
    public function create(array $data, User $user)
    {
        $agendamentoExiste = Appointment::where('scheduled_at', $data['scheduled_at'])->where('barber_id', $data['barber_id'])->where('status', 'pending')->exists();

        if ($agendamentoExiste){
            return false;
        }

        try{
            $barber = Barber::findOrFail($data['barber_id'])->first();
            $service = Service::findOrFail($data['service_id'])->first();
            $price = $service->price;

            $appointment = Appointment::create([
                'user_id' => $user->id,
                'barber_id' => $barber->id,
                'service_id' => $service->id,
                'price' => $price,
                'scheduled_at' => $data['scheduled_at'],
                'created_at' => now()
            ]);
            return true;
        } catch(\Throwable $e) {
            return false;
        }
    }
}