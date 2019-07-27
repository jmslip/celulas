<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(CelulasController $celulasController, PessoasController $pessoasController, MinistracoesController $ministracoesController)
    {
        $qtMembros = $pessoasController->getQuantidadeMembros();
        $qtCelulas = $celulasController->getNumberCelulas();
        $qtMinistracoes = $ministracoesController->getQuantidadeMinistracoes();
        return view('home')->with([
            'qtMembros' => $qtMembros,
            'qtCelulas' => $qtCelulas,
            'qtMinistracoes' => $qtMinistracoes
        ]);
    }
}
