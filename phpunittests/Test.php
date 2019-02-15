<?php
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testThatWeCanGetUserArray()
    {
        $user = new User;

        $this->assertInternalType('array', $user->allAsArray);
    }
}
