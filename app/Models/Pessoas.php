<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoas extends Model
{
    protected $table = 'people';
    public $timestamps = false;

    public function endereco()
    {
      return $this->belongsTo(Enderecos::class, 'id_address');
    }

    public function celulas() {
      return $this->belongsToMany(Celulas::class, 'peoplexsmallgroups', 'id_people', 'id_small_group')->withPivot('leader');
    }
}
