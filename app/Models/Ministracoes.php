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
        return $this->belongsToMany(User::class, UsuariosXMinistracoes::class, 'id_ministration', 'id_user')
                    ->withTimestamps()
                    ->withPivot('active', 'id_user_updated');
    }

    public function file() {
        return $this->hasOne(Files::class, 'ministrations_id', 'id');
    }
}
