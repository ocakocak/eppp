<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'password',
        'id_aktor',
        'id_kesatuan',
        'id_satker',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function kesatuan()
    {
        return $this->belongsTo(Kesatuan::class, 'id_kesatuan');
    }
    public function sigasi()
    {
        return $this->hasMany(Sigasi::class, 'id_user', 'id');
    }
    public function personil()
    {
        return $this->hasMany(Personil::class, 'id_user', 'id');
    }
    public function satker()
    {
        return $this->belongsTo(Satker::class, 'id_satker');
    }
}
