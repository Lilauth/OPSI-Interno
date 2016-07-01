<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desarrollador extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idDesarrollador';
    protected $table = 'Desarrolladores';
    protected $fillable = [
        'NombreDesarrolador',
        'CodigoDesarrollador',
        'Telefono',
        'Mail',
        'Pagina',
        'activo',
        'user_id'
    ]; 

	public function user()
    {
        return $this->belongsTo('App\User');
    }   

    public function mensajesTelefonicos()
    {													
        return $this->hasMany('App\MensajeTelefonico', 'Para');
    } 

    public function asistencias()
    {                                                   
        return $this->hasMany('App\Asistencia', 'idDesarrollador');
    }  
}
