<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Celulas;
use App\Models\Pessoas;
use App\Models\PessoasXCelulas;

class CelulasController extends Controller
{
    private static $tituloCelulasGrid = 'Lista de Células';
    private static $tituloCelulasForm = 'Nova Célula';
    private $error404 = 'Célula não encontrada';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tituloCelulasGrid = self::$tituloCelulasGrid;
        $tituloCelulasForm = self::$tituloCelulasForm;
        $celulas = $this->celulasAtivas();
        $lideres = $this->lideresAtivos();
        return view('sidebar.celulas.celulas', compact('tituloCelulasGrid', 'tituloCelulasForm', 'celulas', 'lideres'));
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
        if (isset($request)) {
          $celula = new Celulas();
          $celula->name = $request->input('nome');
          $celula->description = $request->input('nome');
          $celula->cep = str_replace('-', '', $request->input('cep'));
          $celula->street = $request->input('rua');
          $celula->number = $request->input('numero');
          $celula->neiborhood = $request->input('bairro');
          $celula->city = $request->input('cidade');
          $celula->state = $request->input('estado');
          $celula->save();
        }
        

        return json_encode($celula);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!empty($id)) {
          // Celula
          $celula = Celulas::find($id);

          //Lideres
          $lideresCelula = Celulas::with('pessoas')->where('id', '=', $celula->id)->get();
          $lideres = array();
          $aux = 0;
          foreach ($lideresCelula[0]->pessoas as $lider) {
            $arrLider = Pessoas::find($lider->id);

            if (!empty($arrLider)) {
              $arrLider = $arrLider->toArray();
              $idLider = $arrLider['id'];
              $dicionarioArray = 'pessoa-' . $aux;
              $lideres[$dicionarioArray] = $idLider;
              $aux++;
            }
          }

          $quantidadeLideres['quantidadeLideres'] = $aux;

          $dados_celula = array_merge($celula->toArray(), $lideres, $quantidadeLideres);
        }

        if (isset($dados_celula)) {
          return json_encode($dados_celula);
        }
        return response($this->getError404(), 404);
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
        $celula = Celulas::find($id);

        if(isset($celula)) {
          if ($request->input('name') === null) {
            $celula->active = 0;
            $celula->save();
            return json_encode($celula);
          }
        }
        return response('Célula não encontrada', 404);
    }

    /**
     * Remove the specified resource from storage.$this->
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //
    }

    private function celulasAtivas() {
        return Celulas::active()->get();
    }

    private function lideresAtivos() {
      return Pessoas::active()->where('leader', 1)->get();
    }

    public function getTituloCelulasForm() {
      return $this->tituloCelulasForm;
    }

    private function setTituloCelulasForm($tituloCelulasForm) {
      $this->tituloCelulasForm = $tituloCelulasForm;
    }

    public function getError404() {
      return $this->error404;
    }
}
