<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['fullname'];
    /**
     * Get the books for the author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    /**
     * find books by their author name.
     *
     * @param string $fullname
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function findBooksByAuthorName(string $fullname)
    {
        return Book::whereHas('author', function ($query) use ($fullname) {
            $query->where('fullname', 'like', "%$fullname%");
        });
    }
}
