<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Override;

class Barber extends Model
{
    protected $fillable = [
        'user_id',
        'created_at',
        'updated_at'
    ];

    #[Override]
    protected function casts()
    {
        return [
            'id' => 'integer',
            'user_id' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime'
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function apppointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
