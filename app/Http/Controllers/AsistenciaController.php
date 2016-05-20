<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Asistencia;
use App\Desarrollador;
use App\Funciones;
use Carbon\Carbon;

use Auth;
use View;
use Session;
use DB;

class AsistenciaController extends Controller
{
    public function __construct()
    {
        //no deja acceder sin login
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private function validarAsistencia(Request $request){
        $this->validate($request, [
             'desde' => 'required'
        ]);
    }    

    public function index(Request $request)
    {
        //DESARROLLADORES DEL FILTRO
        $desarrolladores_sel = Funciones::getDesarrolladoresSelect();
        $desarrolladores_sel[100] = '--TODOS--';

        //SETEO EL MES
        if($request->get('mes')){
            $mes = $request->get('mes');
        }
        else
            $mes = (new \Carbon\Carbon)->month;

        //SETEO EL AÑO
        if($request->get('anio')){
            $anio = $request->get('anio');
        }
        else
            $anio = (new \Carbon\Carbon)->year;        

        //DETERMINO SI QUIEREN FILTRO PARA DESARROLLADOR 
        if ($request->get('desarrollador')){
            $id_desarrollador = $request->get('desarrollador');  
        } 
        //NO QUIEREN FILTRADO DE ASISTENCIA, DETERMINO SI HAY USUARIO LOGUEADO
        else{      
            if (Auth::user()){            
                $id_desarrollador = Auth::user()->desarrollador->idDesarrollador;                                                        
            }
            else{
                $id_desarrollador = 100;  
            }    
        }
        //A ESTA ALTURA IDDESARROLLADOR VALE 100 = TODOS O EL ID DE UN DESARROLLADOR
        if($id_desarrollador != 100){
            //RECUPERO AL DESARROLLADOR Y SUS ASISTENCIA
            $query = Desarrollador::findOrFail($id_desarrollador)->asistencias()->whereMonth('Fecha', '=', $mes)->whereYear('Fecha', '=', $anio)->orderBy('Fecha', 'desc');
        }
        else{
            //QUIEREN VER TODOS LOS ASISTENCIA
            $query = Asistencia::whereMonth('Fecha', '=', $mes)->whereYear('Fecha', '=', $anio)->orderBy('Fecha', 'desc');
        }
        //PAGINADO (EN LA VISTA, VEREMOS UN $asistencias->render())
        $asistencias = $query->paginate(30);

        $totales = Funciones::getTotalAsistencias($id_desarrollador, $anio, $mes);

        return view('asistencia.index', array('asistencias' => $asistencias, 'desarrolladores_sel' => $desarrolladores_sel, 'id_desarrollador' => $id_desarrollador, 'mes' => $mes, 'anio' => $anio, 'totales' => $totales));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('asistencia.create', array('desarrolladores_sel' => Funciones::getDesarrolladoresSelect(), 'id_desarrollador' => Auth::user()->desarrollador->idDesarrollador));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validarAsistencia($request);

        $input = $request->all();
        //dd($input);
        //LE DOY A LAS FECHAS UN FORMATO QUE LA BD ENTIENDA
        $fecha = Carbon::createFromFormat('d-m-Y', $request->input('fecha'))->startOfDay();
        $input['fecha'] = $fecha;

        $desde = Carbon::createFromFormat('H:i', $request->input('desde'));
        $input['desde'] = $desde;

        ($input['hasta'] == "") ? ($input['hasta'] = null) : $input['hasta'] = Carbon::createFromFormat('H:i', $request->input('hasta'));

        ($input['debe'] == "") ? ($input['debe'] = null) : $input['debe'] = Carbon::createFromFormat('H:i', $request->input('debe'));

        ($input['recupera'] == "") ? ($input['recupera'] = null) : $input['recupera'] = Carbon::createFromFormat('H:i', $request->input('recupera'));
        
        Asistencia::create($input);

        Session::flash('flash_message', 'Alta de asistencia exitosa!');

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
        $asistencia = Asistencia::findOrFail($id);   

        return View::make('asistencia.edit', array('asistencia' => $asistencia, 'desarrolladores_sel' => Funciones::getDesarrolladoresSelect(), 'id_desarrollador' => $asistencia->idDesarrollador));
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
        $asistencia = Asistencia::findOrFail($id);

        $this->validarAsistencia($request);
        
        $input = $request->all();
        //LE DOY A LAS FECHAS UN FORMATO QUE LA BD ENTIENDA
        $fecha = Carbon::createFromFormat('d-m-Y', $request->input('fecha'))->startOfDay();
        $input['fecha'] = $fecha;

        $desde = Carbon::createFromFormat('H:i', $request->input('desde'));
        $input['desde'] = $desde;

        ($input['hasta'] == "") ? ($input['hasta'] = null) : $input['hasta'] = Carbon::createFromFormat('H:i', $request->input('hasta'));

        ($input['debe'] == "") ? ($input['debe'] = null) : $input['debe'] = Carbon::createFromFormat('H:i', $request->input('debe'));

        ($input['recupera'] == "") ? ($input['recupera'] = null) : $input['recupera'] = Carbon::createFromFormat('H:i', $request->input('recupera'));

        $asistencia->fill($input)->save();

        Session::flash('flash_message', 'Asistencia editada con éxito!');

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
        $asistencia = Asistencia::findOrFail($id);
        $asistencia->delete();
        return redirect('/asistencias');
    }
}
