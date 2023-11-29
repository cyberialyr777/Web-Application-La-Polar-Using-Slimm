<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Marcas extends Eloquent {
    protected $table = 'marcas';
    protected $fillable = [
        'ID_MARCA',
        'MARCA'
    ];
    public $timestamps = [];
}
?>