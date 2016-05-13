<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Asistencia;
use App\Desarrollador;
use Carbon\Carbon;
use App\Funciones;
use Auth;

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
             'Desde' => 'required'
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

        return view('asistencia.index', array('asistencias' => $asistencias, 'desarrolladores_sel' => $desarrolladores_sel, 'id_desarrollador' => $id_desarrollador, 'mes' => $mes, 'anio' => $anio));
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
        $this->validarMensaje($request);

        $input = $request->all();
        
        //dd($request->all());

        //le doy a la fecha un formato que la BD entienda
        $date = Carbon::createFromFormat('d-m-Y', $request->input('Fecha'));
        $input['Fecha'] = $date;         

        MensajeTelefonico::create($input);

        Session::flash('flash_message', 'Alta de mensaje exitosa!');

        return redirect('/mensajes');
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
}
