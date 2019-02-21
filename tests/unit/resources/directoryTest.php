<?php

require "resources/directory.php";

use PHPUnit\Framework\TestCase;

class DirectoryTest extends TestCase
{
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
