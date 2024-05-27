<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the authors index page.
     *
     * @return void
     */
    public function test_authors_index_page()
    {
        Author::factory()->count(30)->create();
        $response = $this->get(route('authors.index'));
        $response->assertStatus(200);
        $response->assertViewHas('authors');
    }

    /**
     * Test editing an author.
     *
     * @return void
     */
    public function test_edit_author_page()
    {
        $author = Author::factory()->create();
        $response = $this->get(route('authors.edit', $author));
        $response->assertStatus(200);
        $response->assertViewHas('author', $author);
    }

    /**
     * Test updating an author.
     *
     * @return void
     */
    public function test_update_author()
    {
        $author = Author::factory()->create([
            'fullname' => 'Original Name',
        ]);
        $response = $this->put(route('authors.update', $author), [
            'fullname' => 'Updated Name',
        ]);
        $response->assertRedirect(route('authors.index'));
        $this->assertDatabaseHas('authors', [
            'id' => $author->id,
            'fullname' => 'Updated Name',
        ]);
    }
}
