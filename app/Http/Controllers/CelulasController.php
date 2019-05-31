<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Celulas;

class CelulasController extends Controller
{
    private static $tituloCelulasGrid = 'Lista de Células';
    private $tituloCelulasForm;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tituloCelulasGrid = self::$tituloCelulasGrid;
        $celulas = $this->celulasAtivas();
        return view('sidebar.celulas.celulas', compact('tituloCelulasGrid', 'celulas'));
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

    public function getTituloCelulasForm() {
      return $this->tituloCelulasForm;
    }

    private function setTituloCelulasForm($tituloCelulasForm) {
      $this->tituloCelulasForm = $tituloCelulasForm;
    }
}
