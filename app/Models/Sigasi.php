<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sigasi extends Model
{
    protected $table = "tb_sigasi";
    protected $primaryKey = "id_sigasi";
    protected $fillable = [
        'id_personil','jenis_penghargaan','tingkat',
        'sumber','nama_penghargaan','nama_prestasi',
        'deskripsi','tanggal_input','keterangan','id_user'
        ,'no_file_bukti_surat','file_bukti_surat','extension_file_bukti_surat','extension_deskripsi'
        ,'nosuratadmin','suratadmin','extensionsuratadmin','keterangan_penghargaan','jenis_surat','jenissuratadmin'
    ];
    public $timestamps = false;
    public function jenisprestasi()
    {
        return $this->belongsTo(Jenisprestasi::class, 'id_jenis_prestasi');
    }
    public function jenispenghargaan()
    {
        return $this->belongsTo(Jenispenghargaan::class, 'id_jenis_penghargaan');
    }
    public function personil()
    {
        return $this->belongsTo(Personil::class, 'id_personil');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function validasi()
    {
        return $this->hasMany(Validasi::class, 'id_sigasi', 'id_sigasi');
    }
    
}
