<?php

namespace App\Http\Controllers;

use App\Interfaces\Siscell;
use Illuminate\Http\Request;
use App\Models\Celulas;

class CelulasController extends Controller
{
    private $view = 'sidebar.celulas.celulas';
    private $error404 = 'Célula não encontrada';
    private $lideres;

    public function index()
    {
        $this->setLideres(array());
        return view($this->view)->with([
            'celulas' => $this->celulasAtivas(),
            'lideres' => $this->getLideres(),
            'infosGrid' => $this->infosGrid()]);
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

                $updCelula = $this->savePessoasXCelulas($request, $celula, $update);

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
            //Celulas e Lideres
            $celulasLideres = Celulas::with(['pessoas' => function($query) {
                $query->where([
                    ['peoplexsmallgroups.leader', true],
                    ['peoplexsmallgroups.active', 1]
                ]);
            }])->where('id', $id)->get();

            $pessoasController = new PessoasController();
            $lideres = $pessoasController->getLideresCelulasAtivos();

            $dados_celula = array_merge($celulasLideres->toArray(), $lideres->toArray());
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
                $this->savePessoasXCelulas($request, $celula);
                return json_encode($celula);
            }
        }
        return response('Célula não encontrada', 404);
    }

    public function celulasAtivas()
    {
        return Celulas::with(['pessoas' => function($query) {
            $query->where([
                ['peoplexsmallgroups.leader', true],
                ['peoplexsmallgroups.active', true]
            ]);
        }])->active()->get();
    }

    private function savePessoasXCelulas($request, $celula, $update = false)
    {
        $arrIdPessoas = array();
        $idPessoas = $request->input('lideres');

        $lideres = $celula->pessoas()->wherePivot('leader', true);

        if (empty($request->input('lideres'))) {
            if ($lideres->count() >= 1) {
                $lideres->detach();
            }
        } else {
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
        $fnEditar = 'celula';

        $utilsController = new UtilsController($title, $headers, $url, $fnEditar);

        return $utilsController->getInfosGrid();
    }

    public function getLideres()
    {
        return $this->lideres;
    }

    public function setLideres($lideres): void
    {
        $this->lideres = $lideres;
    }
}
