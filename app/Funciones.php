<?php

namespace App;

use DB;
use Clientes;

class Funciones 
{
  /*  public function getClientes(){
    	 return Cliente::orderBy('NombreCliente')->lists('NombreCliente', 'IdCliente');
    }*/

    public static function getDesarrolladoresSelect(){
    	$desarrolladores = DB::table('Desarrolladores')->select('NombreDesarrollador', 'idDesarrollador')->where('activo', '1')->get();                        
        $desarrolladores_sel = array();
        foreach($desarrolladores as $des){
            $desarrolladores_sel[$des->idDesarrollador] = $des->NombreDesarrollador;
        }

        return $desarrolladores_sel;
    }

    public static function getEmpresasSelect(){
        $empresas_sel = Cliente::orderBy('NombreCliente')->lists('NombreCliente', 'IdCliente');
        $empresas_sel['0'] = 'Ninguna'; 

        return $empresas_sel;
    }

    public static function getTotalAsistencias($id_desarrollador, $anio, $mes){
        $asistencias = Asistencia::select(DB::raw('idDesarrollador, ROUND(SUM(DATEDIFF(MINUTE, desde, hasta)) / 60, 2) AS horas, (SUM(DATEDIFF(MINUTE, desde, hasta)) % 60) AS minutos'))->where('idDesarrollador', $id_desarrollador)->whereRaw('DATEPART(YEAR, fecha) = ? AND DATEPART(MONTH, fecha) = ?', [$anio, $mes])->groupBy('idDesarrollador')->get();

        $totales = array();
        foreach ($asistencias as $asist) {
            $totales['horas'] = $asist->horas;
            $totales['minutos'] = $asist->minutos;
        }

        return $totales;
    }

}
