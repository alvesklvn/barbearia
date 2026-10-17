<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Override;

class Appointment extends Model
{
    protected $fillable = [
        'user_id',
        'barber_id',
        'service_id',
        'price',
        'status',
        'scheduled_at',
        'created_at',
        'updated_at'
    ];

    #[Override]
    protected function casts()
    {
        return [
            'user_id' => 'integer',
            'id' => 'integer',
            'barber_id' => 'integer',
            'service_id' => 'integer',
            'price' => 'float',
            'scheduled_at' => 'datetime',
            'status' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime'
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function barber(): BelongsTo
    {
        return $this->belongsTo(Barber::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}