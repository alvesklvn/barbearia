<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Resources\AppointmentsResource;
use App\Models\Appointment;
use App\Services\AppointmentService;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function __construct(private AppointmentService $service)
    {
        
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $appointments = Appointment::where('barber_id', $user->id)->get();
        return AppointmentsResource::collection($appointments);
    }

    public function store(StoreAppointmentRequest $request)
    {
        #horario, servico, barbeiro
        $data = $request->validated();
        $user = $request->user();
        if($this->service->create($data, $user)){
            return response()->json(["message" => "agendamento criado com sucesso"]);
        }

        return response()->json(["message" => "erro ao agendar um horário"]);
    }

    public function destroy(Request $request, Appointment $appointment)
    {
        try{
            $user = $request->user();
            $appointment->status = "canceled";
            $appointment->updated_at = now();
            $appointment->save();
            return response()->json(["message" => "agendamento cancelado com sucesso"]);
        } catch (\Throwable $e){
            return response()->json(["message" => "não foi possivel cancelar esse agendamento"], 422);
        }
    }
}