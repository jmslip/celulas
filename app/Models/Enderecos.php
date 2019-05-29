<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enderecos extends Model
{
    protected $table = "addresses";

    public function celulas() {
        return $this->hasMany(Celulas::class, 'id_address', 'id');
    }
}
