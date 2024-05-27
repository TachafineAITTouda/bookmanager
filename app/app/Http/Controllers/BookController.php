<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of existing books with pagination.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $books = Book::paginate(10);

        return view('books.index', compact('books'));
    }
}
