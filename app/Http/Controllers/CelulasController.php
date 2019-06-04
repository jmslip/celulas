<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Celulas;
use App\Models\Pessoas;
use App\Models\Enderecos;

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

          //Endereco da celula
          $enderecoCelula = Enderecos::find($celula->id_address);

          $quantidadeLideres['quantidadeLideres'] = $aux;

          $dados_celula = array_merge($celula->toArray(), $enderecoCelula->toArray(), $lideres, $quantidadeLideres);
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
        $celula = Celulas::find($id);
        if (isset($celula)) {
            return json_encode($celula);
        }
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
     * Remove the specified resource from storage.$this->
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function editCelula($id) {
        $d = [
            'teste1' => 1,
            'teste' => 2
        ];
        return json_encode($d);
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
