<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Apprenti extends User
{
    use HasFactory;
    protected $fillable = [
        'name',
        'lastname',
        'role',
        'email',
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
