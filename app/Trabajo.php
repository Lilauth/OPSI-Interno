<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    public $timestamps = false;
    protected $table = 'Trabajos';
    protected $primaryKey = 'idTrabajo';
    protected $fillable = ['fechaCarga', 'PedidaPor', 'idCliente', 'idSistema', 'Descripcion', 'path', 'idEstado', 'idProgramador', 'DescCorta'];     
    protected $dates = [
        'fechaCarga'
    ];

    public function desarrollador()
    {
        return $this->belongsTo('App\Desarrollador', 'idDesarrollador', 'idProgramador');
    }

    public function sistema()
    {
        return $this->belongsTo('App\Sistema', 'idSistema', 'idSistema');
    }

    public function estado()
    {
        return $this->belongsTo('App\EstadoTrabajo', 'idEstado', 'idEstado');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'idCliente', 'idCliente');
    }
}
