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

    public function desarrollador()
    {                                               //el campo 'idDesarrollador' de esta tabla hace referencia al campo, 'idDesarrollador' de Desarrolladores
        return $this->belongsTo('App\Desarrolador', 'idDesarrollador', 'idDesarrollador');
    }   

    public function scopePorDesarrolador($query, $idDesarrollador)
    {

        $query->where('idDesarrollador', 'like', '%' . $idDesarrollador . '%');
    }      
}
