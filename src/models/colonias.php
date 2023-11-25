<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Colonias extends Eloquent {
    protected $table = 'colonias';
    protected $fillable = [
        'ID_COLONIA',
        'NOMBRE'
    ];
    public $timestamps = [];
}
?>