<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Cobros extends Eloquent {
    protected $table = 'cobros';
    protected $fillable = [
        'NUMERO_DE_FACTURA',
        'ID_CLIENTE',
        'MONTO',
        'FECHA_LIMITE',
        'SERVICIO',
        'FECHA_CREACION',
        'FECHA_ACTUALIZACION'
    ];
    public $timestamps = [];
    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'ID_CLIENTE', 'id_cliente');
    }
}
?>