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
        //CLIENTES DEL FILTRO
        $clientes = Funciones::getClientesSelect();
        $clientes[100000] = '--TODOS--';

        //ESTADOS DEL FILTRO
        $estados = Funciones::getEstadosSelect();
        $estados[100000] = '--TODOS--';

        //DESARROLLADORES DEL FILTRO
        $desarrolladores_sel = Funciones::getDesarrolladoresSelect();
        $desarrolladores_sel[100] = '--TODOS--';

        //DETERMINO SI QUIEREN FILTRO PARA CLIENTE
        if($request->get('cliente')){
            $id_cliente = $request->get('cliente');
        }
        else{
            $id_cliente = 100000;
        }

        //DETERMINO SI QUIEREN FILTRO PARA ESTADO
        if($request->get('estado')){
            $id_estado = $request->get('estado');
        }
        else{
            $id_estado = 100000;
        }
        //DETERMINO SI SE CAMBIÒ EL FRILTRO POR MES (DESDE)
        if($request->get('desde')){
            $desde = Carbon::createFromFormat('d-m-Y', $request->get('desde'));
        }else{
            $desde = Carbon::now()->subMonth();
        }

        //DETERMINO SI SE CAMBIÒ EL FRILTRO POR MES (HASTA)
        if($request->get('hasta')){
            $hasta = Carbon::createFromFormat('d-m-Y', $request->get('hasta'));
        }else{
            $hasta = Carbon::now();
        }

        //DETERMINO SI QUIEREN FILTRO PARA DESARROLLADOR 
        if ($request->get('responsable')){
            $id_desarrollador = $request->get('responsable');  
        } 
        //NO QUIEREN FILTRADO DE TRABAJOS, DETERMINO SI HAY USUARIO LOGUEADO
        else{      
            if (Auth::user()){            
                $id_desarrollador = Auth::user()->desarrollador->idDesarrollador;                                                        
            }
            else{
                $id_desarrollador = 100;  
            }    
        }

        //A ESTA ALTURA IDDESARROLLADOR VALE 100 = TODOS O EL ID DE UN DESARROLLADOR
        $matchThese = [];
        if($id_desarrollador != 100){
            //RECUPERO AL DESARROLLADOR Y SUS TRABAJO
            $matchThese = ['idProgramador' => $id_desarrollador];
        }

        //SIGO FILTRANDO LA CONSULTA POR CLIENTE (SI ES QUE SE REQUIERE)
        if($id_cliente != 100000){
            $matchThese = ['idCliente' => $id_cliente];
        }

        //SIGO FILTRANDO LA CONSULTA POR ESTADO (SI ES QUE SE REQUIERE)
        if($id_estado != 100000){
            $matchThese =['idEstado' => $id_estado];
        }

        $trabajos = Trabajo::where($matchThese)->whereBetween('fechaCarga', array($desde, $hasta))->orderBy('fechaCarga', 'desc')->paginate(30);

        return view('trabajos.index', array('trabajos' => $trabajos, 'desarrolladores_sel' => $desarrolladores_sel, 'id_desarrollador' => $id_desarrollador, 'clientes' => $clientes, 'id_cliente' => $id_cliente, 'estados' => $estados, 'id_estado' => $id_estado, 'desde' => $desde, 'hasta' => $hasta));
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
        $trabajo = Trabajo::findOrFail($id);
        return View::make('trabajos.edit', array('trabajo' => $trabajo, 'desarrolladores' => Funciones::getDesarrolladoresSelect(), 'clientes' => Funciones::getClientesSelect(), 'sistemas' => Funciones::getSistemasSelect(), 'estados' => Funciones::getEstadosSelect()));
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
        $trabajo = Trabajo::findOrFail($id);

        $this->validarTrabajo($request);

        $input = $request->all();
        //LE DOY A LAS FECHAS UN FORMATO QUE LA BD ENTIENDA
        $fecha = Carbon::createFromFormat('d-m-Y', $request->input('fechaCarga'))->startOfDay();
        $input['fechaCarga'] = $fecha;

        $trabajo->fill($input)->save();

        Session::flash('flash_message', 'Trabajo editado con éxito!');

        return redirect('/trabajos');
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
