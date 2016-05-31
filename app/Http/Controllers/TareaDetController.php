<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Funciones;
use App\TareaDet;
use Carbon\Carbon;

use Auth;
use View;
use Session;
use DB;

class TareaDetController extends Controller
{
    public function __construct()
    {
        //no deja acceder sin login
        $this->middleware('auth');
    }

    private function validarTareaDet(Request $request){
        $this->validate($request, [
             'cantHoras' => 'required',
             'idCliente' => 'required',
             'Descripcion' => 'required'
        ]);
    }   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idAsistencia)
    {
        return View::make('tareasdet.create', array('clientes' => Funciones::getClientesSelect(), 'trabajos' => Funciones::getTrabajosSelect(), 'idAsistencia' => $idAsistencia));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validarTareaDet($request);

        $input = $request->all();

        //LE DOY A LAS FECHAS UN FORMATO QUE LA BD ENTIENDA
        ($input['cantHoras'] == "") ? ($input['cantHoras'] = null) : $input['cantHoras'] = Carbon::createFromFormat('H:i', $request->input('cantHoras'));

        TareaDet::create($input);

        Session::flash('flash_message', 'Alta de Tarea exitosa!');

        return redirect('/asistencias');
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
        $tarea = TareaDet::findOrFail($id);

        $this->validarTareaDet($request);

        $input = $request->all();

        //LE DOY A LAS FECHAS UN FORMATO QUE LA BD ENTIENDA
        $cantHoras = Carbon::createFromFormat('H:i', $request->input('cantHoras'));
        $input['cantHoras'] = $cantHoras;

        $tarea->fill($input)->save();

        Session::flash('flash_message', 'Tarea editada con éxito!');

        return redirect('/asistencias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tarea = TareaDet::findOrFail($id);
        $tarea->delete();

        return redirect('/asistencias');
    }
}
