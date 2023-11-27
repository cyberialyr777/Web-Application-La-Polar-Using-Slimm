<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Deudas extends Eloquent {
    protected $table = 'deudas';
    protected $fillable = [
        'NUMERO_DE_FACTURA',
        'ID_PROVEEDOR',
        'MONTO',
        'FECHA_LIMITE',
        'FECHA_CREACION',
        'FECHA_ACTUALIZACION'
    ];
    public $timestamps = [];
    public function proveedor()
    {
        return $this->belongsTo(Clientes::class, 'ID_PROVEEDOR', 'id_proveedor');
    }
}
?>