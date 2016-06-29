<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntradaSalida extends Model
{
    public $timestamps = false;

    protected $table = 'ENTRADA_SALIDA';
    protected $primaryKey = 'idEntradaSalida';    
    protected $fillable = ['Fecha', 'Hora', 'Movimiento', 'Concepto', 'Monto', 'Responsable'];
}
