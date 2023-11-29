<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Modelos extends Eloquent {
    protected $table = 'modelos';
    protected $fillable = [
        'ID_MODELO',
        'MODELO'
    ];
    public $timestamps = [];
}
?>