<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class GmapsController extends Controller
{
    public function index()
    {
        //configuración
        $config = array();
        $config['center'] = 'auto';
        $config['zoom'] = 15;
        $config['onboundschanged'] = '
            marker_0.setOptions({
                position: new google.maps.LatLng(-34.89765419336122, -57.97103421238103)
 
            });
        centreGot = true;';
 
        \Gmaps::initialize($config);
 
        // Colocar el marcador 
        // Una vez se conozca la posición del usuario
        $marker = array();
        \Gmaps::add_marker($marker);
 
        $map = \Gmaps::create_map();
 
        //Devolver vista con datos del mapa
        return view('welcome', compact('map'));
    }
}
