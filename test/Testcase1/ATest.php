<?php
/**
 * Created by PhpStorm.
 * User: frankfleige
 * Date: 15.07.17
 * Time: 12:26
 */

namespace FrankFleige\PHPUnitPlayground\Test\Testcase1;

use FrankFleige\PHPUnitPlayground\Base\A;
use FrankFleige\PHPUnitPlayground\Base\B;
use PHPUnit\Framework\TestCase;

class ATest extends TestCase
{

    /**
     * Bad: We can only test the beginning part ("Hello ") of the response, as it should never change when running the test.
     * Because the name provider is directly instantiated and called within the method to test, 
     * we cannot mock the response.
     * 
     * @see A::sayBadHello()
     */
    public function testSayBadHello()
    {
        $a = new A(null);
        $this::assertEquals("Hello ", substr($a->sayBadHello(),0, 6));
    }

    /**
     * Better approach: The name provider is isolated into it's own method <code>getName</code> within class A.
     * So we can mock the method <code>getName</code> of class A and let it return a fixed value.
     * 
     * @see A::sayBetterHello()
     */
    public function testSayBetterHello() {
        $mockA = $this->getMockBuilder(A::class)
            ->setMethods(['getName'])
            ->getMock();
        $mockA->expects($this->any())->method('getName')->willReturn('Frank');
        /** @var $stubA A */
        $this::assertEquals("Hello Frank", $stubA->sayBetterHello());
    }

    /**
     * Best approach: The name provider is injected to A when creating an instance of it.
     * So we can mock the entire class B or just parts of it and inject the mocked object to the instance of A.
     *
     * @see A::sayBestHello()
     */
    public function testSayBestHello() {
        $stubB = $this->getMockBuilder(B::class)
            ->setMethods(['getName'])
            ->getMock();
        $stubB->expects($this->any())->method('getName')->willReturn('Frank');
        $a = new A($stubB);
        $this::assertEquals("Hello Frank", $a->sayBestHello());
    }
    
    /*
     * BUT WAIT: we also need to test if B->getName() will return random names...
     * Yes, but this belongs to the unit test of class B, not to this one!
     */
}
