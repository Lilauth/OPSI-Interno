<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TareaDet extends Model
{
    public $timestamps = false;
    protected $table = 'TareaDet';
    protected $fillable = ['idCliente', 'Descripcion', 'cantHoras', 'idTrabajo'];     
    protected $dates = ['cantHoras'];
    
    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'idCliente', 'idCliente');
    }

	public function trabajo()
    {
        return $this->belongsTo('App\Trabajo', 'idTrabajo', 'idTrabajo');
    }

    public function asistencia()
    {
        return $this->belongsTo('App\Asistencia', 'idAsistencia', 'idAsistencia');
    }
}
