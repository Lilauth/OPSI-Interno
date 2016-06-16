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
    	$desarrolladores = DB::table('Desarrolladores')->select('NombreDesarrollador', 'idDesarrollador')->where('activo', '1')->orderBy('NombreDesarrollador')->get();                        
        $desarrolladores_sel = array();
        foreach($desarrolladores as $des){
            $desarrolladores_sel[$des->idDesarrollador] = $des->NombreDesarrollador;
        }

        return $desarrolladores_sel;
    }

    public static function getClientesSelect(){
        $Clientes = DB::table('Clientes')->select('NombreCliente', 'idCliente')->orderBy('NombreCliente')->get();                        
        $Clientes_sel = array();
        foreach($Clientes as $des){
            $Clientes_sel[$des->idCliente] = $des->NombreCliente;
        }

        return $Clientes_sel;
    }

    public static function getSistemasSelect(){
        $Sistemas = DB::table('Sistemas')->select('Descripcion', 'idSistema')->orderBy('Descripcion')->get();                        
        $Sistemas_sel = array();
        foreach($Sistemas as $des){
            $Sistemas_sel[$des->idSistema] = $des->Descripcion;
        }
        return $Sistemas_sel;
    }

    public static function getTrabajosSelect(){
        $Trabajos = DB::table('Trabajos')->select(DB::raw('SUBSTRING(Descripcion, 0, 100) AS Descripcion, idTrabajo'))->orderBy('Descripcion')->get();                        
        $Trabajos_sel = array();
        foreach($Trabajos as $des){
            $Trabajos_sel[$des->idTrabajo] = $des->Descripcion;
        }

        return $Trabajos_sel;
    }

    public static function getEstadosSelect(){
        $Estados = DB::table('EstadoTrabajo')->select('Estado', 'idEstado')->orderBy('Estado')->get();                        
        $Estados_sel = array();
        foreach($Estados as $des){
            $Estados_sel[$des->idEstado] = $des->Estado;
        }

        return $Estados_sel;
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
        if(empty($totales)){
            $totales['horas'] = 0;
            $totales['minutos'] = 0;
        }

        return $totales;
    }

    public static function getHorasCliente($id_desarrollador, $desde, $hasta){
        //CONSULTA BASE DE HORAS POR CLIENTE SIN FILTROS
        $horas = DB::table('TareaDet')->selectRaw('idCliente, SUM(DATEPART(HOUR, cantHoras)) AS cantHoras')->join('Asistencia', 'TareaDet.idAsistencia', '=', 'Asistencia.idAsistencia')->groupBy('idCliente');

        //AGREGAMOS FILTRO DE FECHAS (DESDE Y HASTA)
        $horas = $horas->whereBetween('Asistencia.fecha', array($desde, $hasta));

        //AREGAMOS FILTRO POR DESARROLLADOR (SI SE SOLICITA DEL SELECT)
        if($id_desarrollador != 100){
            $horas = $horas->where('idDesarrollador', $id_desarrollador);
        }

        //OBTENEMOS DE LA BD
        $horas->lists('idCliente', 'CantHoras');

        $horas_sel=array();
        foreach ($horas as $key => $value){
            $horas_sel[$key] = $value;
        }

        return $horas;
    }
}
