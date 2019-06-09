<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoas;

class PessoasController extends Controller
{
    public function qtPessoas() {
        $people =  Pessoas::active()->count();

        return json_encode($people);
    }
}
