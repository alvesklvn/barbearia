<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Models\Service;
use App\Services\OfferedServiceService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(private OfferedServiceService $service)
    {

    }

    public function store(StoreServiceRequest $request)
    {
        $data = $request->validated();
        if($this->service->create($data)){
            return response()->json(["message" => "serviço criado com sucesso"]);
        }

        return response()->json(["message" => "não foi possivel criar o serviço"], 422);
    }

    public function destroy(Service $service)
    {
        try{
            $service->delete();
            return response()->json(["message" => "serviço excluído com sucesso"]);
        } catch (\Throwable $e){
            return response()->json(["message" => "não foi possivel excluir o serviço"], 422);
        }
    }
}
