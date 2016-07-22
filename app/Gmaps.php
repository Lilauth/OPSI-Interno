<?php

namespace App;

use DB;
use App\Cliente;

class Gmaps
{
    public static function setMapDefault()
    {
        $config['center'] = '-34.89765419336122, -57.97103421238103';
        $config['zoom'] = 'auto';
        \Gmaps::initialize($config);

        $data['map'] = \Gmaps::create_map();

        //Devolver mapa
        return $data;
    }

    public static function setMapToCreate()
    {
		$config['center'] = '-34.89765419336122, -57.97103421238103';
		$config['zoom'] = '15';
		\Gmaps::initialize($config);

		$marker = array();
		$marker['position'] = '-34.89765419336122, -57.97103421238103';
		$marker['draggable'] = true;
		$marker['ondragend'] = 'document.getElementById("position").value = event.latLng.lat() + 
								", " +  event.latLng.lng()';
		\Gmaps::add_marker($marker);

		$data['map'] = \Gmaps::create_map();

        //Devolver mapa
        return $data;
    }

    public static function setMapToEdit($position)
    {
		($position != null)? $config['center'] = $position : $config['center'] = '-34.89765419336122, -57.97103421238103';
		$config['zoom'] = '15';
		\Gmaps::initialize($config);

		$marker = array();
		($position != null)? $marker['position'] = $position : $marker['position'] = '-34.89765419336122, -57.97103421238103';
		$marker['draggable'] = true;
		$marker['ondragend'] = 'document.getElementById("position").value = event.latLng.lat() + 
								", " +  event.latLng.lng()';
		\Gmaps::add_marker($marker);

		$data['map'] = \Gmaps::create_map();

        //Devolver mapa
        return $data;
	}

    public static function setMapWelcome()
    {
        $config['center'] = '-34.89765419336122, -57.97103421238103';
        $config['zoom'] = '15';
        \Gmaps::initialize($config);

		$marker = array();
		$marker['position'] = '-34.89765419336122, -57.97103421238103';
		\Gmaps::add_marker($marker);

        $data['map'] = \Gmaps::create_map();

        //Devolver mapa
        return $data;
    }

    public static function setClientsMap()
    {
        $config['center'] = '-34.93914082826864, -57.879066467285156';
        $config['zoom'] = '12';
        \Gmaps::initialize($config);

    	$clientes = Cliente::all();

    	foreach ($clientes as $cliente){
    		if($cliente->position != null){
				$marker = array();
				$marker['position'] = $cliente->position;
				$marker['onclick'] = 'alert("'.$cliente->NombreCliente.'")';
				\Gmaps::add_marker($marker);
			}
    	}

        $data['map'] = \Gmaps::create_map();

        //Devolver mapa
        return $data;
    }
}
