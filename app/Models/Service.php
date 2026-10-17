<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Override;

class Service extends Model
{
    protected $fillable = [
        'price',
        'title',
        'description',
        'created_at',
        'updated_at'
    ];

    #[Override]
    protected function casts()
    {
        return [
            'id' => 'integer',
            'title' => 'string',
            'price' => 'float',
            'description' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime'
        ];
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
