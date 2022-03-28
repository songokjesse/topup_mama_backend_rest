<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class BookTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }

    public function test_making_an_api_request_to_book()
    {
        $response = $this->json('GET', '/api/v1/books');
        $response->assertResponseStatus(200);
    }

    public function test_making_an_api_request_to_book_with_filter()
    {
        $response = $this->json('GET', '/api/v1/books', [
            'name' => 'A Game of Thrones'
        ]);
        $response->assertResponseStatus(200);
    }

    public function test_making_an_api_request_to_book_comments()
    {
        $response = $this->json('GET', '/api/v1/book/1/comments');
        $response->assertResponseStatus(200);
    }

}
