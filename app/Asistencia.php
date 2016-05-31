<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    public $timestamps = false;
    protected $table = 'Asistencia';
    protected $primaryKey = 'idAsistencia';
    protected $fillable = ['fecha', 'desde', 'hasta', 'debe', 'recupera', 'idDesarrollador'];     
    protected $dates = [
        'desde',
        'hasta',
        'fecha',
        'debe',
        'recupera'
    ];
    
    public function desarrollador()
    {
        return $this->belongsTo('App\Desarrollador', 'idDesarrollador', 'idDesarrollador');
    }

    public function tareaDet()
    {
        return $this->hasMany('App\TareaDet', 'idAsistencia');
    }
}
