<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if an author can be created successfully.
     *
     * @return void
     */
    public function test_it_can_create_an_author(): void
    {
        $author = Author::create(['fullname' => 'Test Author']);

        $this->assertInstanceOf(Author::class, $author);
        $this->assertEquals('Test Author', $author->fullname);
        $this->assertDatabaseHas('authors', ['fullname' => 'Test Author']);
    }

    /**
     * Test if an author name can be updated successfully.
     *
     * @return void
     */
    public function test_it_can_update_an_author_name(): void
    {
        $author = Author::create(['fullname' => 'Original Name']);
        $author->update(['fullname' => 'Updated Name']);

        $this->assertEquals('Updated Name', $author->fullname);
        $this->assertDatabaseHas('authors', ['fullname' => 'Updated Name']);
    }
}
