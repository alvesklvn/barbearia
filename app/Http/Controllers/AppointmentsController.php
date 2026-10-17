<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Services\AppointmentService;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function __construct(private AppointmentService $service)
    {
        
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
}
