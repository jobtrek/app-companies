<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class, 'entreprise_id');
    }

    public function domains(): BelongsToMany
    {
        return $this->belongsToMany(Domain::class);
    }
}
