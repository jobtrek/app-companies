<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'roles',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'roles' => AsCollection::class,
        ];
    }

    public static function attemptLogin($credentials)
    {
        if (Auth::guard("{$credentials['role']}")->attempt($credentials)) {
            session()->regenerate();

            return redirect()->intended('/');
        } else {
            return back()->withErrors(['role' => 'Login role invalid']);
        }
    }

    public function file(): MorphOne
    {

        return $this->morphOne(File::class, 'fileable');

    }
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'apprentis_id');
    }
}
