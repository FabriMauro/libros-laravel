<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
    //
    public function index()
    {
        //Obtengo los 3 libros más recientes de la base de datos usando el modelo Book
    $books=Book::latest()->take(3)->get();
    return view('index', ['books' => $books]);



        return view('index');
    }
}
