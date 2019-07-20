<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuariosXMinistracoes extends Model
{
    protected $table = 'ministrationsxusers';
    protected $fillable = [
        'id_ministration',
        'id_user',
        'active',
        'id_user_updated'
    ];
    
}
