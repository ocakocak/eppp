<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Validasi extends Model
{
    protected $table = "tb_validasi";
    protected $primaryKey = "id_validasi";
    protected $fillable = [
        'id_sigasi','status','catatan_validasi'
    ];
    public function sigasi()
    {
        return $this->belongsTo(Sigasi::class, 'id_sigasi');
    }
}
