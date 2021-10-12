<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $table = "tb_info";
    protected $primaryKey = "id_info";
    protected $fillable = [
        'judul','informasi','status'
    ];
    public $timestamps = false;
}
