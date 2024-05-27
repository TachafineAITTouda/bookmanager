<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Book;

class BookTest extends TestCase
{
    /**
     * Test if a book can be created successfully.
     *
     * @return void
     */
    public function test_it_can_create_a_book(): void
    {
        $title = 'Test Book';
        $authorName = 'Test Author';

        $book = Book::createBook($title, $authorName);

        $this->assertInstanceOf(Book::class, $book);
        $this->assertEquals($title, $book->title);
        $this->assertEquals($authorName, $book->author->fullname);
        $this->assertDatabaseHas('books', ['title' => $title]);
        $this->assertDatabaseHas('authors', ['fullname' => $authorName]);
    }

    /**
     * Test if an exception is thrown when trying to create a duplicate book.
     *
     * @return void
     */
    public function test_it_throws_exception_if_book_already_exists_on_create(): void
    {
        $this->expectException(\Exception::class);

        $title = 'Test Book';
        $authorName = 'Test Author';

        Book::createBook($title, $authorName);
        Book::createBook($title, $authorName);
    }

    /**
     * Test if a book can be updated successfully.
     *
     * @return void
     */
    public function test_it_can_update_a_book(): void
    {
        $originalTitle = 'Original Book';
        $originalAuthorName = 'Original Author';
        $newTitle = 'Updated Book';
        $newAuthorName = 'Updated Author';

        $book = Book::createBook($originalTitle, $originalAuthorName);
        $updatedBook = $book->updateBook($newTitle, $newAuthorName);

        $this->assertInstanceOf(Book::class, $updatedBook);
        $this->assertEquals($newTitle, $updatedBook->title);
        $this->assertEquals($newAuthorName, $updatedBook->author->fullname);
        $this->assertDatabaseHas('books', ['title' => $newTitle]);
        $this->assertDatabaseHas('authors', ['fullname' => $newAuthorName]);
    }

    /**
     * Test if an exception is thrown when trying to update a book to a duplicate.
     *
     * @return void
     */
    public function test_it_throws_exception_if_book_already_exists_on_update(): void
    {
        $this->expectException(\Exception::class);

        $title1 = 'Test Book 1';
        $authorName1 = 'Test Author 1';
        $title2 = 'Test Book 2';
        $authorName2 = 'Test Author 2';

        $book1 = Book::createBook($title1, $authorName1);
        Book::createBook($title2, $authorName2);

        $book1->updateBook($title2, $authorName2);
    }

    /**
     * Test if a book can be found by its title and author name.
     *
     * @return void
     */
    public function test_it_can_find_a_book_by_title_and_author_name(): void
    {
        $title = 'Test Book';
        $authorName = 'Test Author';

        Book::createBook($title, $authorName);
        $foundBook = Book::findByTitleAndAuthorName($title, $authorName);

        $this->assertInstanceOf(Book::class, $foundBook);
        $this->assertEquals($title, $foundBook->title);
        $this->assertEquals($authorName, $foundBook->author->fullname);
    }
}
