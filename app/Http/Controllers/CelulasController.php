<?php

namespace App\Http\Controllers;

use App\Interfaces\Siscell;
use Illuminate\Http\Request;
use App\Models\Celulas;
use App\Models\Pessoas;

class CelulasController extends Controller
{
    private $view = 'sidebar.celulas.celulas';
    private $error404 = 'Célula não encontrada';


    public function index()
    {
        $infosGrid = $this->infosGrid();
        $celulas = $this->celulasAtivas();
        $lideres = $this->lideresAtivos();
        return view($this->view, compact('celulas', 'lideres', 'infosGrid'));
    }

    public function create()
    {
        //
    }

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

    private function celulasAtivas()
    {
        return Celulas::with(['pessoas' => function($query) {
            $query->where([
                ['peoplexsmallgroups.leader', true],
                ['peoplexsmallgroups.active', true]
            ]);
        }])->active()->get();
    }

    private function lideresAtivos()
    {
        return Pessoas::leftJoin('peoplexsmallgroups', 'people.id', '=', 'peoplexsmallgroups.id_people')
            ->where([
                ['people.leader', true],
                ['people.active', true]
            ])->groupBy('people.id', 'people.name', 'people.lastname')
            ->havingRaw('COUNT(peoplexsmallgroups.id) < ?', [1])
            ->get(['people.id', 'people.name', 'people.lastname']);
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

    private function infosGrid() {
        $title = 'Lista de Células';
        $headers = [
            'Nome',
            'Endereço',
            'Líderes'
        ];
        $url = '/siscell/celulas/';
        $fnEditar = 'editarCelula()';

        $utilsController = new UtilsController($title, $headers, $url, $fnEditar);

        return $utilsController->getInfosGrid();
    }
}
