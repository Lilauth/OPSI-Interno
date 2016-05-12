<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idAsistencia';
    protected $table = 'Asistencia';
    protected $fillable = [
        'Desde',
        'Hasta',
        'Debe',
        'Recupera'
    ];     
    protected $dates = [
        'Desde',
        'Hasta',
        'Fecha'
    ];
    
    public function desarrollador()
    {
        return $this->belongsTo('App\Desarrollador', 'idDesarrollador', 'idDesarrollador');
    }

    //ÉSTO ES PARA QUE ELOQUENT GUARDE LA FECHA SÓLO COMO DATE Y NO DATETIME
    public function setFechaAttribute($date)
    {
        $this->attributes['fecha'] = Carbon::parse($date);
    }
}
