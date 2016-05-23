<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sistema extends Model
{
    public $timestamps = false;

    protected $table = 'Sistemas';
    protected $primaryKey = 'idSistema';    
    protected $fillable = ['Descripcion'];

    public function scopeDescripcion($query, $descripcion)
    {

        $query->where('Descripcion', 'like', '%' . $descripcion . '%');
    }  
}