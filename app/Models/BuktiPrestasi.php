<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuktiPrestasi extends Model
{
    protected $table = "tb_bukti_prestasi";
    protected $primaryKey = "id_bukti_prestasi";
    protected $fillable = [
        'id_sigasi',
        'file_bukti_prestasi','extension'
    ];
    public $timestamps = false;

    public function Pengpres()
    {
        return $this->belongsTo(Pengpres::class, 'id_sigasi');
    }
}
