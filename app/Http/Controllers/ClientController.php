<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Cliente;
use Session;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
        $clientes = Cliente::nombreOContacto($request->get('name'))->orderBy('nombreCliente', 'asc')->paginate(30);        
        return view('clients.index', ['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::lists('NombreCliente', 'IdCliente');

        return view('clients.create');       
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //escupe en pantalla los datos del formulario, con los id
        //dd($request->all());
        
        //valida los campos obligatorios
        $this->validate($request, [
             'NombreCliente' => 'required',
             'Telefono' => 'required'
        ]);

        $input = $request->all();        
        Cliente::create($input);

        Session::flash('flash_message', 'Alta de Cliente exitosa!');

       // return redirect()->back();
       return redirect('/client');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);

        return view('clients.show')->withClient($client);       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($IdCliente)
    {
        $cliente = Cliente::findOrFail($IdCliente);

        return view('clients.edit')->withCliente($cliente);     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdCliente)
    {
        $cliente = Cliente::findOrFail($IdCliente);

        $this->validate($request, [
            'NombreCliente' => 'required',
            'Telefono' => 'required'
        ]);

        $input = $request->all();

        $cliente->fill($input)->save();

        Session::flash('flash_message', 'Client successfully updated!');

       // return redirect()->back();
        return redirect('/client');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $client)
    {
        $client->delete();
        return redirect('/client');
    }
}
