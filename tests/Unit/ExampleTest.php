<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;


class ExampleTest extends TestCase
{

    public function test_getUserById()
    {
        $userObj = User::getUserById(1);

        $this->assertTrue(is_object($userObj));
    }

    public function test_getUserByIdIsFalse()
    {
        $userObj = User::getUserById(10);

        $this->assertTrue(!is_object($userObj));
    }

    public function test_updateUserComments()
    {
        $userObj    = User::getUserById(1);

        $newComment = "new comment" . time();
        $checkTrue  = User::updateUserComments($userObj, $newComment);

        $userObj    = User::getUserById(1);

        $this->assertTrue($checkTrue);
        $this->assertStringContainsString($newComment, $userObj->comments);
    }


}
