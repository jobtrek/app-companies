<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entreprise extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'email',
        'description',
        'website',
        'photo'
    ];

    public function domain(): BelongsTo
    {
        return $this->belongsTo(Domain::class);
    }
}
