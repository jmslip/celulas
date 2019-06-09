<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Celulas;
use App\Models\Pessoas;

class CelulasController extends Controller
{
    private static $tituloCelulasGrid = 'Lista de Células';
    private $error404 = 'Célula não encontrada';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tituloCelulasGrid = self::$tituloCelulasGrid;
        $celulas = $this->celulasAtivas();
        $lideres = $this->lideresAtivos();
        return view('sidebar.celulas.celulas', compact('tituloCelulasGrid', 'tituloCelulasForm', 'celulas', 'lideres'));
    }

    public function grid() {
        $celulas = $this->celulasAtivas();

        $jsonCelulas['celulas'] = $celulas;

        return json_encode($jsonCelulas);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $celula = null;
        $updCelula = null;
        $update = false;

        if (isset($request)) {
            try {
                if (!empty($request->input('idCelula'))) {
                    $celula = Celulas::find($request->input('idCelula'));
                    $update = true;
                } else {
                    $celula = new Celulas();
                }
                $celula->name = $request->input('nome');
                $celula->description = $request->input('nome');
                $celula->cep = str_replace('-', '', $request->input('cep'));
                $celula->street = $request->input('rua');
                $celula->number = $request->input('numero');
                $celula->neiborhood = $request->input('bairro');
                $celula->city = $request->input('cidade');
                $celula->state = $request->input('estado');
                $celula->save();

                if ($request->input('lideres') !== null) {
                    $updCelula = $this->savePessoasXCelulas($request->input('lideres'), $celula, $update);
                }

                if (is_null($updCelula)) {
                    return json_encode($celula);
                } else {
                    return json_encode($updCelula);
                }
            } catch (Throwable $th) {
                return json_encode($th);
            }
        }


        return json_encode($celula);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!empty($id)) {
            // Celula
            $celula = Celulas::find($id);

            //Lideres
            $lideresCelula = Celulas::with(['pessoas' => function($query) {
                $query->where([
                    ['peoplexsmallgroups.leader', true],
                    ['peoplexsmallgroups.active', 1]
                ]);
            }])->where('id', $celula->id)->get();
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $celula = Celulas::find($id);

        if (isset($celula)) {
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function celulasAtivas()
    {
        return Celulas::with(['pessoas' => function($query) {
            $query->where([
                ['peoplexsmallgroups.leader', true],
                ['peoplexsmallgroups.active', 1]
            ]);
        }])->active()->get();
    }

    private function lideresAtivos()
    {
        return Pessoas::active()->where('leader', 1)->get();
    }

    private function savePessoasXCelulas($idPessoas, $celula, $update = false)
    {
        $arrIdPessoas = array();

        //Apaga todos os lideres da célula
        $celula->pessoas()->wherePivot('leader', true)->detach();

        try {
            foreach ($idPessoas as $idPessoa) {
                $arrIdPessoas[$idPessoa] = ['leader' => true];
            }
            $celula->pessoas()->attach($arrIdPessoas);
            return $celula;
        } catch (Throwable $throwable) {
            return $throwable;
        }
    }

    public function getNumberCelulas() {
        $celulas  = Celulas::active()->count();

        return json_encode($celulas);
    }

    public function getError404()
    {
        return $this->error404;
    }
}
