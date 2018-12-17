<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    //
    protected $fillable = [
        'idDepartamento',
        'Departamento'
    ];

    protected $table = 'DEPARTAMENTO';
}
