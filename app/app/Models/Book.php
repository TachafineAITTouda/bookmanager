<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author_id'];

    /**
     * Book belongs to an author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Find a book by its title and author name.
     *
     * @param string $title
     * @param string $authorName
     * @return \App\Models\Book|null
     */
    public static function findByTitleAndAuthorName(string $title, string $authorName): ?Book
    {
        return static::whereHas('author', function ($query) use ($authorName) {
            $query->where('fullname', $authorName);
        })->where('title', $title)->first();
    }

    /**
     * Create a new book with the given title and author name.
     *
     * @param string $title
     * @param string $authorName
     * @return \App\Models\Book
     * @throws \Exception
     */
    public static function createBook(string $title, string $authorName): Book
    {
        if (null !== static::findByTitleAndAuthorName($title, $authorName)){
            throw new Exception('Book already exists.');
        }else{
            $author = Author::firstOrCreate([
                'fullname' => $authorName,
            ]);

            return static::create([
                'title' => $title,
                'author_id' => $author->id,
            ]);
        }
    }

    /**
     * Update the book with the given title and author name.
     *
     * @param string $title
     * @param string $authorName
     * @return \App\Models\Book
     * @throws \Exception
     */
    public function updateBook(string $title, string $authorName): Book
    {
        $book = static::findByTitleAndAuthorName($title, $authorName);

        if ($book && $book->id !== $this->id){
            throw new Exception('Book already exists.');
        } else {
            $author = Author::firstOrCreate([
                'fullname' => $authorName,
            ]);

            $this->title = $title;
            $this->author_id = $author->id;
            $this->save();

            return $this;
        }
    }

    /**
     * Find a book by its title or a substring of its title.
     *
     * @param string $title
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function findByTitle(string $title)
    {
        return static::where('title', 'like', "%$title%");
    }
}
