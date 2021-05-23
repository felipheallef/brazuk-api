<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Http\Controllers\Account\SignupController;

class SignupTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPasswordValid()
    {
        $password = "f83hnIGv68";
        $controller = new SignupController();
        $invalid = $controller->validatePassword($password);
        $valid = $controller->validatePassword($password.'#');

        $this->assertEquals(
            false, $invalid
        );

        $this->assertTrue($valid);
    }
}
