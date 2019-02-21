<?php


require "/resources/admin/classes/common/Utility.php";

use PHPUnit\Framework\TestCase;

class UtilityTest extends TestCase
{
    public function testSecondsFromDays() {
        $utility = new Utility();
        $this->assertSame(3628800, $utility->secondsFromDays(42));
    }
}
