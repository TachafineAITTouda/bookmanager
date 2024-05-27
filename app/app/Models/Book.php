<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
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
            if ($this->author_id !== $author->id && $this->author->books->count() === 1){
                $this->author->delete();
            }

            $this->title = $title;
            $this->author_id = $author->id;
            $this->save();

            return $this;
        }
    }

    /**
     * Method scopeFilters
     *
     * @param Builder $query
     * @param ?array $filter
     * @param ?array $sort
     *
     * @return void
     */
    public function scopeFilters(
        Builder $query,
        ?array $filters,
        ?array $sort
    ):void {
        if(is_array($filters))
        {
             // Run the query based on the field and value
             foreach ($filters as $field => $searchFor) {
                switch ($field) {
                    case 'title':
                        $query->where(DB::raw('upper('.$field.')'),'like','%'.strtoupper($searchFor).'%');
                        break;
                    case 'authorname':
                        $query->whereHas('author', function ($query) use ($searchFor) {
                            $query->where(DB::raw('upper(fullname)'),'like','%'.strtoupper($searchFor).'%');
                        });
                        break;
                    case 'created_at':
                    case 'updated_at':
                        $query->where($field,$searchFor);
                        break;
                    default:
                        $query;
                        break;
                }
            }
        }

        if(is_array($sort)) {
            $field = key($sort);
            $direction = reset($sort);
            $query->when(
                $field,
                static function (Builder $query, $field) use ($direction): void {
                   match($field) {
                        'title' => $query->orderBy($field , !empty($direction) ? $direction : 'ASC'),
                        'authorname' => $query->join('authors', 'authors.id', '=', 'books.author_id')
                            ->orderBy('authors.fullname', !empty($direction) ? $direction : 'ASC'),
                       default => $query,
                   };
               }
           );
        }

    }

}
