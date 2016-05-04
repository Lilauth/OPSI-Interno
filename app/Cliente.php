<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
	public $timestamps = false;
    protected $primaryKey = 'IdCliente';

    protected $fillable = [
        'NombreCliente',
        'Telefono',
        'OtrosNombres',
        'idNivel',
        'Mantenimiento',
        'Observaciones'
    ]; 

    public function scopeNombreOContacto($query, $nombreCliente)
    {

        $query->where('NombreCliente', 'like', '%' . $nombreCliente . '%')->orWhere('OtrosNombres', 'like', '%' . $nombreCliente . '%');

    }  
}
