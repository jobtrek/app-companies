<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Commentaire extends Model
{
    public function file(): MorphMany
    {

        return $this->morphMany(File::class, 'fileable');

    }
}
