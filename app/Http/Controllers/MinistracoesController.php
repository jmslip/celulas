<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ministracoes;

class MinistracoesController extends Controller
{
    private $title = "Ministrações";
    private $view = "sidebar.ministracoes.ministracoes";
    private $isModalCEP = false;

    public function index()
    {
        $ministracoes = array();
        return view($this->view)->with([
            'title' => $this->title,
            'infosGrid' => $this->infosGrid(),
            'dados' => $ministracoes,
            'isModalCEP'    => $this->isModalCEP
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
        $ministracao = null;
        $update = false;

        if (isset($request)) {
            if (!empty($request->input('idMinstracao'))) {
                $ministracao = Ministracoes::find($request->input('idMinistracao'));
                $update = true;
            } else {
                $ministracao = new Ministracoes();
            }

            $anexar = $request->input('anexar') ? 1 : 0;

            $ministracao->name = $request->input('nome');
            $ministracao->description = $request->input('ministracao');
            $ministracao->attachment = $anexar;
            $ministracao->number = $request->input('numeroMinistracao');
            $ministracao->save();
            
            if ($anexar == 1) {
                $filesController = new FilesController();
                $filesController->anexaArquivo($request, $ministracao);
            }
        }
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
