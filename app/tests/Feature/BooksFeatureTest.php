<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BooksFeatureTest extends TestCase
{
    /**
     * Test if the books homepage page loads
     * @return void
     */
    public function testBooksPageLoads()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test if a book can be created
     * @return void
     */
    public function testBookCanBeCreated()
    {
        $response = $this->post('/books', [
            'title' => 'The Great Gatsby',
            'authorname' => 'F. Scott Fitzgerald'
        ]);

        $response->assertStatus(302);
    }

    /**
     * Test if a book can not be created without a title or author name
     * @return void
     */
    public function testBookCannotBeCreatedWithoutTitleOrAuthorName()
    {
        $response = $this->post('/books', [
            'title' => '',
            'authorname' => ''
        ]);

        $response->assertSessionHasErrors(['title', 'authorname']);
    }

    /**
     * Test if a book can be updated
     * @return void
     */
    public function testBookCanBeUpdated()
    {
        $bookToUpdate = Book::createBook("test update", "test update");

        $response = $this->put('/books/' . $bookToUpdate->id, [
            'title' => 'test update 1',
            'authorname' => 'test update 1'
        ]);
        $bookToUpdate->delete();
        $response->assertStatus(302);
    }

    /**
     * Test if a book can be deleted
     * @return void
     */
    public function testBookCanBeDeleted()
    {
        $bookToDelete = Book::createBook("test delete", "test delete");

        $response = $this->delete('/books/' . $bookToDelete->id);
        $response->assertStatus(302);
    }
}
