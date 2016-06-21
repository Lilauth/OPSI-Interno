<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Nivel;

use Auth;
use View;
use Session;
use DB;


class NivelesController extends Controller
{
    public function __construct()
    {
        //no deja acceder sin login
        $this->middleware('auth');
    }

    private function validarNivel(Request $request){
        $this->validate($request, [
             'Descripcion' => 'required'
        ]);
    }  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $niveles = Nivel::all();
        return view('niveles.index', ['niveles' => $niveles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('niveles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validarNivel($request);

        $input = $request->all();

        Nivel::create($input);

        Session::flash('flash_message', 'Alta de nivel exitosa!');

        return redirect('/niveles');
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
        $nivel = Nivel::findOrFail($id);
        return View::make('niveles.edit', array('nivel' => $nivel));
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
        $nivel = Nivel::findOrFail($id);

        $this->validarNivel($request);
        
        $input = $request->all();

        $nivel->fill($input)->save();

        Session::flash('flash_message', 'nivel editado con éxito!');

        return redirect('/niveles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nivel = Nivel::findOrFail($id);
        $nivel->delete();
        return redirect('/niveles');
    }
}
