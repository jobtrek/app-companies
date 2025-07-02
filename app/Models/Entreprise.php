<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function domains(): BelongsToMany
    {
        return $this->belongsToMany(Domain::class);
    }
}
