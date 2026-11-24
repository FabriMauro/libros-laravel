<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
    //
    public function index()
    {
        //Obtengo todos los libros de la base de datos usando el modelo Book
    $books=Book::all();
    return view('index', ['books' => $books]);



        return view('index');
    }
}
