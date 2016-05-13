<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idAsistencia';
    protected $table = 'Asistencia';
    protected $fillable = ['Desde'];     
    protected $dates = [
        'Desde',
        'Hasta',
        'Fecha',
        'Debe',
        'Recupera'
    ];
    
    public function desarrollador()
    {
        return $this->belongsTo('App\Desarrollador', 'idDesarrollador', 'idDesarrollador');
    }

    public function setFechaAttribute($date)
    {
        //ÉSTO ES PARA QUE ELOQUENT GUARDE LA FECHA SÓLO COMO DATE Y NO DATETIME
        strlen($fecha)? Carbon::parse('d/m/Y', $fecha) : null;
    }
}
