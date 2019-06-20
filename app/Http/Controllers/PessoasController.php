<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoas;

class PessoasController extends Controller
{
    private $view = 'sidebar.pessoas.pessoas';

    public function index()
    {
        $infosGrid = $this->infosGrid();
        $membros = $this->getMembrosAtivos();
        return view($this->view, compact('membros', 'infosGrid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getQuantidadeMembros() {
        $membros = Pessoas::active()->count();

        return json_encode($membros);
    }

    private function getMembrosAtivos() {
        return Pessoas::with(['celulas' => function($query) {
            $query->where([
                ['small_groups.active', true],
                ['peoplexsmallgroups.active', true]
            ]);
        }])->active()->get();
    }

    private function infosGrid() {
        $title = 'Lista de Membros';
        $headers = [
            'Nome',
            'Sobrenome',
            'Endereço',
            'Data de Nascimento',
            'Célula'
        ];
        $url = '/siscell/membros/';
        $fnEditar = 'editarMembro()';

        $utilsController = new UtilsController($title, $headers, $url, $fnEditar);

        return $utilsController->getInfosGrid();
    }
}
