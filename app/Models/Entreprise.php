<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Entreprise extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'email',
        'description',
        'website',
        'photo',
        'domain_id',
    ];

    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class, 'entreprise_id');
    }

    public function domain(): BelongsTo
    {
        return $this->belongsTo(Domain::class);
    }
}
