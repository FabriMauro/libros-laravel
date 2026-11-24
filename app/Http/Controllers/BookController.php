<?php

namespace App\Http\Controllers;
use App\Models\Book;

use Illuminate\Http\Request;

class BookController extends Controller
{
    //
    public function index()
    {
        //Obtengo todos los libros de la base de datos usando el modelo Book
        $books=Book::all();
        return view('books.index', ['books' => $books]);
    }

    public function show($id)
    {
        // Obtengo el libro de la base de datos usando el modelo Book
        $book = Book::findOrFail($id);
        return view('books.show', ['book' => $book]);
    }


}
