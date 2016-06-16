<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Funciones;
use App\Asistencia;
use App\TareaDet;
use \Carbon\Carbon;

use Auth;
use View;
use Session;
use DB;

class InformesController extends Controller
{
    function horasCliente(Request $request){
    	$desarrolladores=Funciones::getDesarrolladoresSelect();
		$desarrolladores[100] = '--TODOS--';

        //DETERMINO SI QUIEREN FILTRO PARA DESARROLLADOR 
        if ($request->get('desarrollador')){
            $id_desarrollador = $request->get('desarrollador');  
        } 
        //NO QUIEREN FILTRADO POR DESARROLLADOR, DETERMINO SI HAY USUARIO LOGUEADO
        else{      
            if (Auth::user()){            
                $id_desarrollador = Auth::user()->desarrollador->idDesarrollador;
            }
            else{
                $id_desarrollador = 100;
            }    
        }

        //DETERMINO SI SE CAMBIÓ EL FRILTRO POR MES (DESDE)
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

        $horas = DB::table('TareaDet')
            ->join('Asistencia', 'TareaDet.idAsistencia', '=', 'Asistencia.idAsistencia')
            ->join('Clientes', 'TareaDet.idCliente', '=', 'Clientes.idCliente')            
            ->selectRaw('Clientes.NombreCliente as cliente, SUM(DATEPART(HOUR, cantHoras)) AS horas')
            ->where('idDesarrollador', $id_desarrollador)
            ->whereBetween('Asistencia.fecha', array($desde, $hasta))
            ->groupBy('Clientes.NombreCliente')
            ->get();

    	return view('informes.horasclientes', array('horas'=> $horas, 'desarrolladores' => $desarrolladores, 'id_desarrollador' => $id_desarrollador, 'desde' => $desde, 'hasta' => $hasta));
    }
}
