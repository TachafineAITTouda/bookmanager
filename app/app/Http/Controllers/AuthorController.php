<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
class AuthorController extends Controller
{
    /**
     * Display a listing of existing authors with pagination.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $authors = Author::paginate(25);

        return view('authors.index', compact('authors'));
    }

    /**
     * Display form to edit author.
     *
     * @param \App\Models\Author $author
     * @return \Illuminate\View\View
     */
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    /**
     * Update author in the database.
     *
     * @param \App\Models\Author $author
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $author->update($request->validated());

        return redirect()->route('authors.index');
    }
}

