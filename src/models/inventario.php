<?php 

namespace App\Models;

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Inventario extends Eloquent
{
    protected $table = 'inventarios';
    protected $primaryKey = 'ID_REFACCION';
    protected $fillable = [
        'ID_MARCA',
        'ID_MODELO',
        'REFACCION',
        'CANTIDAD',
        'FECHA_ENTRADA',
        'FECHA_SALIDA',
    ];
    public $timestamps = [];

    public function marca()
    {
        return $this->belongsTo(Marcas::class, 'ID_MARCA', 'id_marca');
    }

    public function modelo()
    {
        return $this->belongsTo(Modelos::class, 'ID_MODELO', 'id_modelo');
    }
}

?>
