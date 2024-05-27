<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BooksTest extends TestCase
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
}
