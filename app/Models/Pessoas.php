<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoas extends Model
{
    protected $table = 'people';
    public $timestamps = false;

    public function scopeActive($query) {
      return $query->where('active', 1);
    }

    public function celulas() {
      return $this->belongsToMany(Celulas::class, 'peoplexsmallgroups', 'id_people', 'id_small_group')->withPivot('leader', 'active');
    }
}
