<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoTrabajo extends Model
{
    public $timestamps = false;

    protected $table = 'EstadoTrabajo';
    protected $primaryKey = 'idEstado';    
    protected $fillable = ['Estado', 'codColor'];
}