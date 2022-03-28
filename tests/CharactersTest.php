<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CharactersTest extends TestCase
{
    public function test_making_an_api_request_to_characters()
    {
        $response = $this->json('GET', '/api/v1/characters');
        $response->assertResponseStatus(200);
    }

}
