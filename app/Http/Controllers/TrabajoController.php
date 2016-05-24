<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Trabajo;
use App\Desarrollador;
use App\Cliente;
use App\Sistema;
use App\Funciones;
use Carbon\Carbon;

use Auth;
use View;
use Session;
use DB;

class TrabajoController extends Controller
{
    public function __construct()
    {
        //NO DEJA ACCEDER SIN LOGIN
        $this->middleware('auth');
    }

    private function validarTrabajo(Request $request){
        $this->validate($request, [
             'fechaCarga' => 'required',
             'idCliente' => 'required',
             'idEstado' => 'required'
        ]);
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        if ($request->get('responsable')){
            $id_desarrollador = $request->get('responsable');  
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
            $query = Trabajo::where('idProgramador', '=', $id_desarrollador)->whereMonth('fechaCarga', '=', $mes)->whereYear('fechaCarga', '=', $anio)->orderBy('fechaCarga', 'desc');
        }
        else{
            //QUIEREN VER TODOS LOS ASISTENCIA
            $query = Trabajo::whereMonth('fechaCarga', '=', $mes)->whereYear('fechaCarga', '=', $anio)->orderBy('fechaCarga', 'desc');
        }

        $trabajos = $query->paginate(30);

        return view('trabajos.index', array('trabajos' => $trabajos, 'desarrolladores_sel' => $desarrolladores_sel, 'id_desarrollador' => $id_desarrollador, 'mes' => $mes, 'anio' => $anio));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('trabajos.create', array('desarrolladores' => Funciones::getDesarrolladoresSelect(), 'clientes' => Funciones::getClientesSelect(), 'sistemas' => Funciones::getSistemasSelect(), 'estados' => Funciones::getEstadosSelect()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validarTrabajo($request);

        $input = $request->all();
        
        //dd($request->all());

        //le doy a la fecha un formato que la BD entienda
        $date = Carbon::createFromFormat('d-m-Y', $request->input('fechaCarga'));
        $input['fechaCarga'] = $date;         

        Trabajo::create($input);

        Session::flash('flash_message', 'Alta de Trabajo exitosa!');

        return redirect('/trabajos');
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
        $trabajo = Trabajo::findOrFail($id);
        $trabajo->delete();
        return redirect('/trabajos');
    }
}
