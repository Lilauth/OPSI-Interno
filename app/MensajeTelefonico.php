<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MensajeTelefonico extends Model
{
	public $timestamps = false;

    protected $table = 'MensajesTelefonicos';
    protected $primaryKey = 'idMensaje';
    protected $fillable = [
        'Fecha',
        'idCliente',
        'Cliente',
        'idDesarrollador',
        'Mensaje',
        'Para',
        'visto'
    ]; 

    public function desarrollador()
    {                                               //foreign_key      //local_key
        return $this->belongsTo('App\Desarrollador', 'Para', 'idDesarrollador');
    }   
}
