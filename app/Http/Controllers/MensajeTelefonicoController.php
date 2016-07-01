<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\MensajeTelefonico;
use App\Cliente;
use App\Desarrollador;
use App\Funciones;

use DB;
use View;
use Carbon\Carbon; 
use Session;
use Auth;
use Mail;

class MensajeTelefonicoController extends Controller
{
    public function __construct()
    {
        //no deja acceder sin login
        $this->middleware('auth');
    }

    /*funciones propias*/    

    public function setVisto($id, $checked){
        $mensaje = MensajeTelefonico::findOrFail($id);
        $mensaje['visto'] = $checked;
        $mensaje->save();

        Session::flash('flash_message', 'Mensaje editado con éxito!');
        
        return redirect('/mensajes');
    }

    private function getClientesSel(){
        $clientes_sel = Cliente::orderBy('NombreCliente')->lists('NombreCliente', 'IdCliente');
        $clientes_sel['0'] = 'Ninguna'; 

        return $clientes_sel;
    }

    private function validarMensaje(Request $request){
        $this->validate($request, [
             'Mensaje' => 'required',
             'Cliente' => 'required',
             'Para' => 'required'
        ]);
    }

    public function getMensajesCliente(Request $request){
        $mensajes = Desarrollador::findOrFail($request->get('id'))->mensajesTelefonicos()->where('visto','0')->orderBy('Fecha', 'desc')->get();
//        $mensajes = MensajeTelefonico::where('idDesarrollador', '=', $request->get('id'))->where('visto','0')->get();

        return $mensajes->count();
    }

    /*fin de funciones*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        //desarrolladores del filtro
        $desarrolladores_sel = Funciones::getDesarrolladoresSelect();
        $desarrolladores_sel[100] = '--TODOS--';
        //determino si quieren filtro para desarrollador        
        if ($request->get('para')) {
            $id_desarrollador = $request->get('para');  
        } 
        //no quieren filtrado de mensajes, determino si hay usuario logueado
        else{      
            if (Auth::user()){            
                $id_desarrollador = Auth::user()->desarrollador->idDesarrollador;                                                        
            }
            else{
                $id_desarrollador = 100;  
            }    
        }
        //a esta altura idDesarrollador vale 100 = TODOS o el id de un desarrollador
        if($id_desarrollador != 100){
            //recupero al desarrollador y sus mensajes
            $query = Desarrollador::findOrFail($id_desarrollador)->mensajesTelefonicos()->orderBy('Fecha', 'desc'); 
           // $mensajes = Desarrollador::findOrFail($id_desarrollador)->mensajesTelefonicos()->orderBy('Fecha', 'desc')->paginate(30);
        }
        else{
            //quieren ver todos los mensajes
            $query = MensajeTelefonico::orderBy('Fecha', 'desc');
            //$mensajes = MensajeTelefonico::orderBy('Fecha', 'desc')->paginate(30);  
        } 
        //aplico filtro de visto         
        if ($request->get('visto') == 1){
            $visto = 1;
            $query = $query->where('visto','1');
        }
        else{        
            if(is_null($request->get('visto')) or ($request->get('visto') == 2)) {
               $visto = 2; 
               $query = $query->where('visto','0');  
            }
            else{
                $visto = 3;
            }
        }
        $mensajes = $query->paginate(30);         

        return view('mensajes.index', array('mensajes' => $mensajes, 'desarrolladores_sel' => $desarrolladores_sel, 'id_desarrollador' => $id_desarrollador, 'visto' => $visto ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {               
        return View::make('mensajes.create', array('clientes_sel' => $this->getClientesSel(), 'desarrolladores_sel' => Funciones::getDesarrolladoresSelect()));
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

        $succes_message = 'Alta de mensaje exitosa!';

        if(isset($input['Mail'])){
            $this->sendanemail($request);
            $succes_message .= '. Se ha enviado un mail de manera exitosa tambi&eacute;n';
        }

        //le doy a la fecha un formato que la BD entienda
        $date = Carbon::createFromFormat('d-m-Y', $request->input('Fecha'));
        $input['Fecha'] = $date;         

        MensajeTelefonico::create($input);

        Session::flash('flash_message', $succes_message);

        return redirect('/mensajes');
    }

    private function sendanemail(Request $request){
        $remitente = $request->input('Cliente');
        $cliente =  Cliente::findOrFail($request->input('idCliente'));
        $destinatario = Desarrollador::findOrFail($request->input('Para'));
        $mensaje =  $request->input('Mensaje');

        $data['content'] = $mensaje;
        $data['remitente'] = $remitente;
        $data['cliente'] = $cliente;
        $data['destinatario'] = $destinatario;

        Mail::send('emails.template', $data, function ($message) use($destinatario){
            $message->subject('Mensaje automático de Sistema Interno Opsi');
            $message->to(($destinatario->idDesarrollador == 9)? $destinatario->Mail : 'openfg.soft@gmail.com');
        });
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
        $mensaje = MensajeTelefonico::findOrFail($id);   

        return View::make('mensajes.edit', array('mensaje' => $mensaje, 
                                                 'clientes_sel' => Funciones::getEmpresasSelect(), 
                                                 'desarrolladores_sel' => Funciones::getDesarrolladoresSelect()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idMensaje)
    {
        $mensaje = MensajeTelefonico::findOrFail($idMensaje);

        $this->validarMensaje($request);
        
        $input = $request->all();

        $mensaje->fill($input)->save();

        Session::flash('flash_message', 'Mensaje editado con éxito!');

        return redirect('/mensajes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mensaje = MensajeTelefonico::findOrFail($id);
        $mensaje->delete();
        return redirect('/mensajes');
    }
}
