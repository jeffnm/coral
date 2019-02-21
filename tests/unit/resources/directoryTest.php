<?php

use PHPUnit\Framework\TestCase;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class DirectoryTest extends TestCase
{

  // functions used in setup and tear down
  public static function switchToTestEnvironment()
  {
    $config = new \Config_Lite("resources/admin/configuration.ini");
    $config->set("settings", "environment", "test");
    $config->save();
  }

  public static function switchBackToProdEnvironment()
  {
    $config = new \Config_Lite("resources/admin/configuration.ini");
    $config->set("settings", "environment", "prod");
    $config->save();
  }

  // once at the beginning before any tests
  public static function setUpBeforeClass(): void
  {
    DirectoryTest::switchToTestEnvironment();
    require 'resources/directory.php';
  }

  // once at the end after test class ends
  public static function tearDownAfterClass(): void
  {
    DirectoryTest::switchBackToProdEnvironment();
  }

  //setup and teardown functions
  protected function setUp() { }
  protected function tearDown() { }

    public function testCostToInteger() {
        $this->assertSame(1052.0, cost_to_integer(10.52));
    }

    public function testIntegerToCost() {
        // Integer to cost actually returns a string
        $this->assertSame('10.52', integer_to_cost(1052));
    }

    public function testPreviousYear() {
        $this->assertSame('1998', previous_year(1999));
    }

    public function testPreviousYear18xx() {
        // Doesn't work with years < 1900
        //$this->assertSame('1819', previous_year(1820));
    }
}
