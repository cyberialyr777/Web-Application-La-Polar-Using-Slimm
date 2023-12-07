<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Facturas extends Eloquent {
    protected $table = 'facturas_clientes';
    protected $primaryKey = 'NUMERO_DE_FACTURA';
    protected $fillable = [
        'ID_CLIENTE',
        'ARCHIVO',
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