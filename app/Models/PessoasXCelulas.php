<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PessoasXCelulas extends Model
{
    protected $table = "peoplexsmallgroups";
    public $timestamps = false;

    public function findPessoasXCelulasByPessoaAndCelula($idPeople, $idSmallGroup) {

    }
}
