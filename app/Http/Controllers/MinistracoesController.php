<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ministracoes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;
use App\Models\UsuariosXMinistracoes;

class MinistracoesController extends Controller
{
    private $title = "Ministrações";
    private $view = "sidebar.ministracoes.ministracoes";
    private $isModalCEP = false;

    public function index()
    {   
        $ministracoes = $this->getAllMinistrations();
        return view($this->view)->with([
            'title' => $this->title,
            'infosGrid' => $this->infosGrid(),
            'dados' => $ministracoes,
            'isModalCEP'    => $this->isModalCEP,
            'usuarioLogado' => Auth::user()->name
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
        $anexar = 0;
        $update = false;

        if (isset($request)) {
            DB::beginTransaction();
            try {
                    if (!empty($request->input('idMinistracao'))) {
                        $ministracao = Ministracoes::with('users')->where('ministrations.id', $request->input('idMinistracao'))->firstOrFail();
                        foreach ($ministracao->getRelation('users') as $m) {
                            $userId = $m->getAttribute('id');
                        }
                        $update = true;
                    } else {
                        $ministracao = new Ministracoes();
                        $anexar = $request->input('anexar') ? 1 : 0;
                        $userId = Auth::id();
                    }

                    $ministracao->name = $request->input('nome');
                    $ministracao->description = $request->input('ministracao');
                    if (!$update)
                        $ministracao->attachment = $anexar;
                    $ministracao->number = $request->input('numeroMinistracao');
                    $ministracao->save();

                    if ($update) {
                        $newUser = [
                            'id_user_updated' => Auth::id()
                        ];
                        $ministracao->users()->updateExistingPivot($userId, (new UsuariosXMinistracoes($newUser))->toArray());
                    } else {
                        $ministracao->users()->attach($userId);
                    }

                    if ($anexar == 1) {
                        $filesController = new FilesController();
                        $filesController->anexaArquivo($request, $ministracao);
                    }
                    DB::commit();
            } catch (Throwable $tr) {
                DB::rollBack();
                return json_encode('Erro ao realizar a transação: '.$tr->getCode());
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
        if (!empty($id)) {
            try {
                // $ministracao = Ministracoes::where('id', $id)->get();
                $ministracao = Ministracoes::leftJoin('files', 'ministrations.id', '=', 'files.ministrations_id')
                                                ->leftJoin('ministrationsxusers', 'ministrations.id', '=', 'ministrationsxusers.id_ministration')
                                                ->leftJoin('users', 'ministrationsxusers.id_user', '=', 'users.id')
                                                ->where('ministrations.id', $id)
                                                ->get([
                                                    'ministrations.*',
                                                    'files.id as fileId',
                                                    'files.name as fileName',
                                                    'files.path',
                                                    'files.type',
                                                    'files.size',
                                                    'users.id as idUser',
                                                    'users.name as nameUser'
                                                ]);

                if (!empty($ministracao)) {
                    return json_encode($ministracao->toArray());
                }
            } catch (\Throwable $tr) {
                return json_encode($tr);
            }
        }
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
        if (!empty($request)) {
            DB::beginTransaction();
            try {
                $ministracao = Ministracoes::find($id);
                if ($request->input('tipo') == 'fileDelete') {
                    $ministracao->attachment = 0;
                    $this->deleteFile($ministracao);
                    $ministracao->save();
                } else {
                    $this->deleteFile($ministracao);
                    $ministracao->delete();
                }
                DB::commit();
            } catch (Throwable $tr) {
                DB::rollBack();
                abort(500, 'Error');
                return json_encode('Erro ao realizar a transação: '.$tr->getCode());
            }
        }
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

    private function getAllMinistrations() {
        return Ministracoes::all();
    }

    private function deleteFile($ministracao) {
        $filesController = new FilesController();
        $filesController->apagaArquivo($ministracao->id);
    }
}
