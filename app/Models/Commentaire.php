<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Commentaire extends Model
{
    use HasFactory;
    public function file(): MorphMany
    {

        return $this->morphMany(File::class, 'fileable');

    }

    protected $fillable = [
        'title',
        'description',
        'coach_id',
        'apprentis_id',
    ];
}
