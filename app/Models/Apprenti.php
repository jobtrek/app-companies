<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apprenti extends User
{
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
