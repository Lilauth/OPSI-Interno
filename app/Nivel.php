<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    public $timestamps = false;

    protected $table = 'Niveles';
    protected $primaryKey = 'idNivel';    
    protected $fillable = ['Descripcion', 'codColor'];
}
