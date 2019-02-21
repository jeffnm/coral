<?php

use PHPUnit\Framework\TestCase;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
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
  }

  // once at the end after test class ends
  public static function tearDownAfterClass(): void
  {
  }

  //setup and teardown functions
  protected function setUp()
  {
    UserTest::switchToTestEnvironment();
    require 'auth/directory.php';
  }
  protected function tearDown()
  {
    UserTest::switchBackToProdEnvironment();
  }

  // begin actual tests
  public function testThatAllAsArrayReturnsArray()
  {
    $user = new User;

    $this->assertInternalType('array', $user->allAsArray);
  }

  public function testThatAllAsArrayHasExpectedKeys()
  {
    $user = new User;
    $array = $user->allAsArray;

    $this->assertArrayHasKey('loginID', $array[0]);
    $this->assertArrayHasKey('password', $array[0]);
    $this->assertArrayHasKey('passwordPrefix', $array[0]);
    $this->assertArrayHasKey('adminInd', $array[0]);
  }

  public function testThatProcessLoginReturnsFalseWithEmptyPassword()
  {
    $user = new User(new NamedArguments(array('primaryKey' => 'coral_test')));
    $response = $user->processLogin('');

    $this->assertInternalType('boolean', $response);
    $this->assertFalse($response);
  }

  public function testThatProcessLoginReturnsTrueWithKnownUsernameAndPassword()
  {
    $user = new User(new NamedArguments(array('primaryKey' => 'coral_test')));
    $response = $user->processLogin('coral_test');

    $this->assertInternalType('boolean', $response);
    $this->assertNotFalse($response);

  }
}
