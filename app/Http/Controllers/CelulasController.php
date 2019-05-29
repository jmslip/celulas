<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Celulas;

class CelulasController extends Controller
{

    private $celula;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->celulasAtivas();
        $celulas = $this->getCelula();
        $celulaspessoas = $this->celulasPessoas();
        foreach ($celulaspessoas as $celula) {
          echo $celula->pessoas;
        }
        dd();
        return view('sidebar.celulas.celulas', compact('celulas'));
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

    private function celulasAtivas() {
        $celulasAtivas = Celulas::active()->get();
        $this->setCelula($celulasAtivas);
    }

    private function celulasPessoas() {
      return Celulas::with('pessoas')->get();
    }

    public function getCelula() {
        return $this->celula;
    }

    private function setCelula($celula) {
        $this->celula = $celula;
    }
}
