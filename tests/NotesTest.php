<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NotesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testusergetmethodbyid()
    {
            $response = $this->call('GET', '/api/notes?user=1');
            $this->assertEquals(200, $response->status());
    }
    public function testuserlisting()
    {
            $response = $this->call('GET', '/api/notes');
            $this->assertEquals(200, $response->status());
    }
    
    public function testjsonstore()
    {
        $json = '{
            "posts": [{
                "user_id" : 1,
                "title" : "post1",
                "content" : "sadsetest"
            },
            {
                "user_id" : 2,
                "title" : "post5",
                "content" : "somasdst"
            },
            {
                "user_id" : 3,
                "title" : "post6",
                "content" : "sdsast"
            },
            {
                "user_id" : 999,
                "title" : "post7",
                "content" : "tas"
            }
            ]
        }';
            $response = $this->json('POST', '/api/notes', array('$request' => $json))->see('This user does not exist');
            
    }
}
