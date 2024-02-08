<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatSemanas extends Model
{
    //
    protected $table = 'cat_semanas';

    protected $fillable = [
        'id', 'semana', 'inicio', 'fin', 'ejercicio', 'userid_created', 'userid_updated', 'activo',
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
