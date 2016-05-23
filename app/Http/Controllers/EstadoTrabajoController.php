<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\EstadoTrabajo;

use Auth;
use View;
use Session;
use DB;

class EstadoTrabajoController extends Controller
{
    public function __construct()
    {
        //no deja acceder sin login
        $this->middleware('auth');
    }

    private function validarEstado(Request $request){
        $this->validate($request, [
             'Estado' => 'required'
        ]);
    }     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estados = EstadoTrabajo::all();
        return view('estadotrabajo.index', ['estadosTrabajo' => $estados]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('estadotrabajo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validarEstado($request);

        $input = $request->all();

        EstadoTrabajo::create($input);

        Session::flash('flash_message', 'Alta de estado exitosa!');

        return redirect('/estadostrabajo');
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
        $estado = EstadoTrabajo::findOrFail($id);
        return View::make('estadotrabajo.edit', array('estadotrabajo' => $estado));
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
        $estado = EstadoTrabajo::findOrFail($id);

        $this->validarEstado($request);
        
        $input = $request->all();

        $estado->fill($input)->save();

        Session::flash('flash_message', 'Estado editado con éxito!');

        return redirect('/estadostrabajo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estadoTrabajo = EstadoTrabajo::findOrFail($id);
        $estadoTrabajo->delete();
        return redirect('/estadostrabajo');
    }
}
