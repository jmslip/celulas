<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Ministracoes extends Model
{
    protected $table = 'ministrations';
    protected $fillable = ['name', 'description', 'attachment', 'number'];
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class, 'ministrationsxusers', 'id_ministration', 'id_user');
    }

    public function file() {
        return $this->hasOne(Files::class, 'ministrations_id', 'id');
    }
}
