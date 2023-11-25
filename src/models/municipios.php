<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Municipios extends Eloquent {
    protected $table = 'municipios';
    protected $fillable = [
        'ID_MUNICIPIO',
        'NOMBRE'
    ];
    public $timestamps = [];
}
?>