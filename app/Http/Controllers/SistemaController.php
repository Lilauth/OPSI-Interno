<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Sistema;

use View;
use DB;
use Auth;
use Session;

class SistemaController extends Controller
{
    public function __construct()
    {
        //no deja acceder sin login
        $this->middleware('auth');
    }

    private function validarSistema(Request $request){
        $this->validate($request, [
             'Descripcion' => 'required'
        ]);
    }   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sistemas = Sistema::descripcion($request->get('name'))->orderBy('Descripcion')->paginate(15);
        return view('sistemas.index', array('sistemas' => $sistemas));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('sistemas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validarSistema($request);

        $input = $request->all();

        Sistema::create($input);

        Session::flash('flash_message', 'Alta de sistema exitosa!');

        return redirect('/sistemas');
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
        $sistema = Sistema::findOrFail($id);
        return View::make('sistemas.edit', array('sistema' => $sistema));
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
        $sistema = Sistema::findOrFail($id);

        $this->validarSistema($request);
        
        $input = $request->all();

        $sistema->fill($input)->save();

        Session::flash('flash_message', 'Sistema editado con éxito!');

        return redirect('/sistemas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sistema = Sistema::findOrFail($id);
        $sistema->delete();
        return redirect('/sistemas');
    }
}
