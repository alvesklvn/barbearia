<?php

namespace App\Http\Resources;

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $service = Service::findOrFail($this->service_id);
        $user = User::findOrFail($this->user_id);
        return [
            'title' => $service->title,
            'user' => $user->name,
            'price' => $this->price,
            'scheduled_at' => $this->scheduled_at,
            'status' => $this->status,
            'created_at' => $this->created_at,   
        ];
    }
}
