<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * Book belongs to an author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
