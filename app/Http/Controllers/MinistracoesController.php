<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MinistracoesController extends Controller
{
    private $title = "Ministrações";
    private $view = "sidebar.ministracoes.ministracoes";

    public function index()
    {
        $ministracoes = array();
        return view($this->view)->with([
            'title' => $this->title,
            'infosGrid' => $this->infosGrid(),
            'dados' => $ministracoes
        ]);
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

    private function infosGrid() {
        $title = 'Lista de Ministrações';
        $headers = [
            'Número',
            'Título',
            'Descrição',
            'Anexo?'
        ];
        $url = '/siscell/ministracoes/';
        $fnEditar = 'ministracoes';

        $utilsController = new UtilsController($title, $headers, $url, $fnEditar);

        return $utilsController->getInfosGrid();
    }
}
