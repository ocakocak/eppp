<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuktiPenghargaan extends Model
{
    protected $table = "tb_bukti_penghargaan";
    protected $primaryKey = "id_bukti_penghargaan";
    protected $fillable = [
        'id_sigasi',
        'file_bukti_penghargaan','extension'
    ];
    public $timestamps = false;

    public function Pengpres()
    {
        return $this->belongsTo(Pengpres::class, 'id_sigasi');
    }
}
