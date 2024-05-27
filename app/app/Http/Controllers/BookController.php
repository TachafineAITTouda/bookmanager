<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchBooksRequest;
use App\Http\Requests\StoreBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Enums\BookSortDirectionEnum;
use App\Models\Enums\BookSortEnum;
use Exception;
class BookController extends Controller
{
    /**
     * Display a listing of existing books with pagination.
     *
     * @return \Illuminate\View\View
     */
    public function index(SearchBooksRequest $request)
    {
        $sort = $request->sort;
        $direction = $request->direction;

        $searchTitle = $request->stitle;
        $searchAuthorName = $request->sauthorname;

        $books = null;
        if ($searchTitle || $searchAuthorName || $sort || $direction) {
            $filters = [
                'title' => $searchTitle,
                'authorname' => $searchAuthorName
            ];
            $sort = [$sort => $direction];
            $books = Book::filters(
                $filters,
                $sort
            )->paginate(25);
        } else {
            $books = Book::paginate(25);
        }

        return view('books.index', compact('books'));
    }

    /**
     * Store a new book in the database.
     */
    public function store(StoreBookRequest $request)
    {
        $authorName = $request->authorname;
        $title = $request->title;

        try {
            Book::createBook($title, $authorName);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('books.index');
    }

    /**
     * Edit a book.
     *
     * @param \App\Models\Book $book
     * @return \Illuminate\View\View
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update a book in the database.
     *
     * @param \App\Http\Requests\StoreBookRequest $request
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreBookRequest $request, Book $book)
    {
        $authorName = $request->authorname;
        $title = $request->title;

        try {
            $book->updateBook($title, $authorName);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Delete a book from the database.
     *
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }


}
