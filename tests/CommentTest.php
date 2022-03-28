<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CommentTest extends TestCase
{

    public function test_making_an_api_request_to_comments()
    {
        $response = $this->get('/api/v1/comments');
        $response->assertResponseStatus(200);
    }

    public function test_add_new_comments(){
        $response = $this->json('POST', '/api/v1/comments', [
            'comment' => 'Test Comment',
            'book_id' => 1,
        ]);
        $response->assertResponseStatus(200);
    }


}
