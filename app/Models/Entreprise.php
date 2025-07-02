<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
