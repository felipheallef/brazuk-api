<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');
        $version = $this->app->version();

        $this->assertEquals(
            "{\"error\":{\"code\":418,\"description\":\"I'm a teapot\"}}", $this->response->getContent()
        );
    }
}
