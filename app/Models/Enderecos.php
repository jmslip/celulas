<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enderecos extends Model
{
    protected $table = "addresses";
    public $timestamps = false;

    public function celulas() {
        return $this->hasMany(Celulas::class, 'id_address', 'id');
    }

    public function pessoas() {
      return $this->hasMany(Pessoas::class, 'id_address', 'id');
    }
}
