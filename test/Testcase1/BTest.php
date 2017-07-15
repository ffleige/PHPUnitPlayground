<?php
/**
 * Created by PhpStorm.
 * User: frankfleige
 * Date: 15.07.17
 * Time: 13:23
 */

namespace FrankFleige\PHPUnitPlayground\Test\Testcase1;

use FrankFleige\PHPUnitPlayground\Base\B;
use PHPUnit\Framework\TestCase;

class BTest extends TestCase
{
    /**
     * helper method: calls a function/class method <code>$times</code> times
     * 
     * @param callback $func function or class method to be called
     * @param integer $times number of times the function/class method should be called
     * @return array array with results of the function calls
     */
    private function callXTimes($func, $times) {
        $result = [];
        while($times > 0) {
            $result[] = call_user_func($func);
            $times--;
        }
        return $result;
    }

    /**
     * unit test for method getName() of B
     */
    public function testGetName() {
        $b = new B();
        $result = $b->getName();
        /*
         * basic tests
         */
        // the result of getName() must not be empty
        $this->assertNotEmpty($result);
        // getName() must return a string
        $this->assertInternalType("string", $result);
        /*
         * test if getName() will return random results
         */
        $result1 = $this->callXTimes([$b,'getName'], 10);
        $result2 = $this->callXTimes([$b,'getName'], 10);
        $this->assertNotEquals($result1, $result2);
    }
}
