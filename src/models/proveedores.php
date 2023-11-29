<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Proveedores extends Eloquent
{
    protected $table = 'proveedores';
    protected $primaryKey = 'ID_PROVEEDOR';
    protected $fillable = [
        'ID_MUNICIPIO',
        'ED_ESTADO',
        'ID_COLONIA',
        'NOMBRE',
        'TELEFONO',
        'CORREO',
        'REPRESENTANTE_NOMBRE',
        'REPRESENTANTE_APELLIDO_PATERNO',
        'CALLE',
        'NUMERO',
        'C_P_',
        'FECHA_CREACION',
        'FECHA_ACTUALIZACION'
    ];
    public $timestamps = [];

    public function municipio()
    {
        return $this->belongsTo(Municipios::class, 'ID_MUNICIPIO', 'id_municipio');
    }

    public function estado()
    {
        return $this->belongsTo(Estados::class, 'ID_ESTADO', 'id_estado');
    }

    public function colonia()
    {
        return $this->belongsTo(Colonias::class, 'ID_COLONIA', 'id_colonia');
    }
}
