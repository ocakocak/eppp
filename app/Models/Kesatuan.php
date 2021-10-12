<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kesatuan extends Model
{
    protected $table = "tb_kesatuan";
    protected $primaryKey = "id_kesatuan";
    protected $fillable = [
        'kesatuans'
    ];
    public $timestamps = false;
    public function personil()
    {
        return $this->hasMany(Personil::class, 'id_kesatuan', 'id_kesatuan');
    }
    public function user()
    {
        return $this->hasMany(User::class, 'id_kesatuan', 'id_kesatuan');
    }
    public function satker()
    {
        return $this->hasMany(User::class, 'id_kesatuan', 'id_kesatuan');
    }
}
