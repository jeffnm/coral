<?php
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
// functions used in setup and tear down
  public function switchToTestEnvironment() {
    $config = new \Config_Lite("admin/configuration.ini");
    $config->set("settings", "environment", "test");
    $config->save();
  }

  public function switchBackToProdEnvironment() {
    $config = new \Config_Lite("admin/configuration.ini");
    $config->set("settings", "environment", "prod");
    $config->save();
  }

// once at the beginning before any tests
  public static function setUpBeforeClass(): void
  {
    $this->switchToTestEnvironment();
  }

// once at the end after tests (why? not sure it's needed since build is destroyed after)
  public static function tearDownAfterClass(): void
  {
    $this->switchBackToProdEnvironment();
  }

// begin actual tests
  public function testThatWeCanGetUserArray(){
    $user = new User;

    $this->assertInternalType('array', $user->allAsArray);
  }
}
