<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satker extends Model
{
    protected $table = "tb_satker";
    protected $primaryKey = "id_satker";
    protected $fillable = [
        'satkers','id_kesatuan'
    ];
    public $timestamps = false;
    public function personil()
    {
        return $this->hasMany(Personil::class, 'id_satker', 'id_satker');
    }
    public function user()
    {
        return $this->hasMany(User::class, 'id_satker', 'id_satker');
    }
    public function kesatuan()
    {
        return $this->belongsTo(Kesatuan::class, 'id_kesatuan');
    }
}
