<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coach extends User
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
