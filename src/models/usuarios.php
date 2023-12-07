<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Usuarios extends Eloquent {
    protected $table = 'usuarios';
    protected $fillable = [
        'ID',
        'NOMBRE',
        'APELLIDO_PATERNO',
        'APELLIDO_MATERNO',
        'CORREO',
        'CONTRASENA',
        'FECHA_CREACION',
        'FECHA_ACTUALIZACION'
    ];
    public $timestamps = [];
}
?>