<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ministracoes extends Model
{
    use SoftDeletes;

    protected $table = 'ministrations';
    protected $fillable = ['name', 'description', 'attachment', 'number', 'active'];
    protected $dates = ['deleted_at'];
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

    public function scopeGetMinistracao($query, $id) {
        $query->withTrashed()
                ->leftJoin('files', 'ministrations.id', '=', 'files.ministrations_id')
                ->leftJoin('ministrationsxusers', 'ministrations.id', '=', 'ministrationsxusers.id_ministration')
                ->leftJoin('users', 'ministrationsxusers.id_user', '=', 'users.id')
                ->where('ministrations.id', $id)
                ->get([
                    'ministrations.*',
                    'files.id as fileId',
                    'files.name as fileName',
                    'files.path',
                    'files.type',
                    'files.size',
                    'users.id as idUser',
                    'users.name as nameUser'
                ]);
    }

    public function scopeActive($query) {
        return $query->where('active', 1);
    }

    public function scopeInactive($query) {
        return $query->where('active', 0);
    }

    public function scopeTrash($query) {
        return $query->onlyTrashed();
    }
}
