<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personil extends Model
{
    protected $table = "tb_personil";
    protected $primaryKey = "id_personil";
    protected $fillable = [
        'nama','nrpnip','id_pangkat',
        'jabatan','id_kesatuan','id_user','id_satker'
    ];
    public $timestamps = false;
    public function sigasi()
    {
        return $this->hasMany(Sigasi::class, 'id_personil', 'id_personil');
    }
    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class, 'id_pangkat');
    }
    public function kesatuan()
    {
        return $this->belongsTo(Kesatuan::class, 'id_kesatuan');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
    public function satker()
    {
        return $this->belongsTo(Satker::class, 'id_satker');
    }
}
