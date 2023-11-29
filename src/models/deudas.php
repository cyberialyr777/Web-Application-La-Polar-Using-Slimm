<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Deudas extends Eloquent {
    protected $table = 'deudas';
    protected $primaryKey = 'NUMERO_DE_FACTURA';
    protected $fillable = [
        'ID_PROVEEDOR',
        'MONTO',
        'FECHA_LIMITE',
        'FECHA_CREACION',
        'FECHA_ACTUALIZACION'
    ];
    public $timestamps = [];
    public function proveedor()
    {
        return $this->belongsTo(Proveedores::class, 'ID_PROVEEDOR', 'id_proveedor');
    }
}
?>