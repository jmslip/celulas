<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoas;

class PessoasController extends Controller
{
    private $view = 'sidebar.pessoas.pessoas';

    public function index()
    {
        $celulasController = new CelulasController();

        return view($this->view)->with([
            'membros'   => $this->getMembrosAtivos(),
            'infosGrid' => $this->infosGrid(),
            'celulas'   => $celulasController->celulasAtivas()
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
        $people = Pessoas::find($id);

        if (isset($people)) {
            if(empty($request->input('name'))) {
                $people->active = 0;
                $people->save();
                return json_decode($people);
            }
        }
        return json_decode('Membro não encontrada');
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
