<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Convention extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'entreprise_id',
        'date_de_départ',
        'date_de_retour'
    ];

    public function user():  BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function entreprise(): BelongsTo
    {
        return $this->belongsTo(Entreprise::class);
    }
}
