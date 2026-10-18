<?php 

namespace App\Services;

use App\Models\Service;

class OfferedServiceService
{
    public function create(array $data)
    {
        try{
            Service::create([
                'title' => $data['title'],
                'price' => $data['price'],
                'description' => $data['description'],
                'created_at' => now()
            ]);
            return true;
        } catch (\Throwable $e){
            return false;
        }
    }
}