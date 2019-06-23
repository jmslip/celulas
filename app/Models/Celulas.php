<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Celulas extends Model
{
    protected $table = "small_groups";
    public $timestamps = false;

    public function scopeActive($query) {
        return $query->where('active', 1);
    }

    public function scopeInactive($query) {
        return $query->where('active', 0);
    }

    public function pessoas() {
      return $this->belongsToMany('App\Models\Pessoas', 'peoplexsmallgroups', 'id_small_group', 'id_people')->withPivot('leader', 'active', 'id');
    }
}
