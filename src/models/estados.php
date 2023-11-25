<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Estados extends Eloquent {
    protected $table = 'estados';
    protected $fillable = [
        'ID_ESTADO',
        'NOMBRE'
    ];
    public $timestamps = [];
}
?>