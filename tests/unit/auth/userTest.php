<?php

include_once 'auth/directory.php';

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
// functions used in setup and tear down
  public static function switchToTestEnvironment()
  {
    $config = new \Config_Lite("auth/admin/configuration.ini");
    $config->set("settings", "environment", "test");
    $config->save();
  }

  public static function switchBackToProdEnvironment()
  {
    $config = new \Config_Lite("auth/admin/configuration.ini");
    $config->set("settings", "environment", "prod");
    $config->save();
  }

// once at the beginning before any tests
  public static function setUpBeforeClass(): void
  {
    UserTest::switchToTestEnvironment();
  }

// once at the end after tests (why? not sure it's needed since build is destroyed after)
  public static function tearDownAfterClass(): void
  {
    UserTest::switchBackToProdEnvironment();
  }

// begin actual tests
  public function testThatAllAsArrayReturnsArray()
  {
    $user = new User;

    $this->assertInternalType('array', $user->allAsArray);
  }

  public function testThatAllAsArrayHasCorrectKeys()
  {
    $user = new User;
    $array = $user->allAsArray;

    $this->assertArrayHasKey('loginID', $array[0]);
    $this->assertArrayHasKey('password', $array[0]);
    $this->assertArrayHasKey('passwordPrefix', $array[0]);
    $this->assertArrayHasKey('adminInd', $array[0]);
  }
}
