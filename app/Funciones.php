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
}
