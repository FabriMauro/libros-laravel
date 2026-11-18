<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{ //protected $table = 'books'; // Especifica el nombre de la tabla asociada al modelo
    // fillable permite asignar valores a los campos de la tabla de libros

    protected $fillable = [
        'title',
        'author',
        'genre',
        'published_year',
        'description',
    ];
}
