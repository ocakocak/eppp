<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    protected $table = "tb_pangkat";
    protected $primaryKey = "id_pangkat";
    protected $fillable = [
        'pangkats'
    ];
    public $timestamps = false;
    public function personil()
    {
        return $this->hasMany(Personil::class, 'id_pangkat', 'id_pangkat');
    }
}
