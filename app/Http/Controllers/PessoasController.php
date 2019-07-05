<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoas;

class PessoasController extends Controller
{
    private $title = 'Membros';
    private $view = 'sidebar.pessoas.pessoas';

    public function index()
    {
        $celulasController = new CelulasController();

        return view($this->view)->with([
            'dados'   => $this->getMembrosAtivos(),
            'infosGrid' => $this->infosGrid(),
            'celulas'   => $celulasController->celulasAtivas(),
            'title'     => $this->title
        ]);
    }

    public function store(Request $request)
    {
        $pessoa = null;
        $update = false;

        if (isset($request)) {
            if (!empty($request->input('idMembro'))) {
                $pessoa = Pessoas::find($request->input('idMembro'));
                $update = true;
            } else {
                $pessoa = new Pessoas();
            }

            $pessoa->name = $request->input('nome');
            $pessoa->lastname = $request->input('sobrenome');
            $pessoa->leader = $request->input('lider') ? 1 : 0;
            $pessoa->birthday = $request->input('dtNascimento');;
            $pessoa->phone = $request->input('telefone');
            $pessoa->cellphone = $request->input('celular');
            $pessoa->cep = str_replace('-', '', $request->input('cep'));
            $pessoa->street = $request->input('rua');
            $pessoa->number = $request->input('numero');
            $pessoa->neiborhood = $request->input('bairro');
            $pessoa->city = $request->input('cidade');
            $pessoa->state = $request->input('estado');
            $pessoa->save();

            if (!empty($request->input('celula')) && $request->input('celula') != 0) {
                if (!$update) {
                    $pessoa->celulas()->attach($request->input('celula'));
                } else {
                    $pessoa->celulas()->detach();
                    $pessoa->celulas()->attach($request->input('celula'));
                }
            } else {
                $pessoa->celulas()->detach();
            }

        }
    }

    public function show($id)
    {
        if (!empty($id)) {
            try {
                $people = Pessoas::with(['celulas' => function($query) {
                    $query->where([
                        ['peoplexsmallgroups.active', true]
                    ]);
                }])->active()
                ->where('id', $id)
                ->get();

                if (isset($people)) {
                    return json_encode($people->toArray());
                }
            } catch (\Throwable $tr) {
                return json_encode($tr);
            }
        }
    }

    public function update(Request $request, $id)
    {
        $people = Pessoas::find($id);

        if (isset($people)) {
            if(empty($request->input('name'))) {
                $people->active = 0;
                $people->save();
                return json_encode($people);
            }
        }
        return response('Membro não encontrado', 404);
    }

    public function getLideresAtivos() {
        return json_encode(Pessoas::active()->where('leader', true)->get(['id', 'name', 'lastname']));
    }

    public function getLideresCelulasAtivos() {
        return Pessoas::leftJoin('peoplexsmallgroups', function($join) {
            $join->on('people.id', '=', 'peoplexsmallgroups.id_people')
                ->where('peoplexsmallgroups.active', true);
        })
                        ->where([
                            ['people.leader', true],
                            ['people.active', true]
                        ])->groupBy('people.id', 'people.name', 'people.lastname')
                        ->havingRaw('COUNT(peoplexsmallgroups.id) < ?', [1])
                        ->get(['people.id', 'people.name', 'people.lastname']);
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
        $fnEditar = 'membro';

        $utilsController = new UtilsController($title, $headers, $url, $fnEditar);

        return $utilsController->getInfosGrid();
    }
}
