<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $fillable = ['number', 'name', 'file', 'type', 'size'];
    public $timestamps  = false;

    public function ministracao() {
        return $this->belongsTo(Ministracoes::class, 'ministrations_id', 'id');
    }
}
