<?php
/**
 * Created by PhpStorm.
 * User: frankfleige
 * Date: 17.07.17
 * Time: 14:07
 */

namespace FrankFleige\PHPUnitPlayground\Test\Sample3;

use FrankFleige\PHPUnitPlayground\Sample3\B;
use FrankFleige\PHPUnitPlayground\Sample3\C;
use PHPUnit\Framework\TestCase;

class BTest extends TestCase
{
    /**
     * creates a mocked instance of C with the given entitlement keys
     * @param array $e array with entitlement keys
     * @return C|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getMockedInstanceWithEntitlements($e) {
        $cr = $this->getMockBuilder(C::class)
            ->disableOriginalConstructor()
            ->setMethods(['getConfig'])
            ->getMock();
        $cr->expects($this::once())
            ->method('getConfig')
            ->with('entitlements')
            ->willReturn($e);
        return $cr;
    }

    /**
     * @covers B::getEntitlements()
     */
    public function testGetEntitlements() {
        // no entitlements
        $b = new B($this->getMockedInstanceWithEntitlements([]));
        $k = $b->getEntitlements();
        $this::assertInternalType("array", $k);
        $this::assertEmpty($k);
        // two entitlements
        $b = new B($this->getMockedInstanceWithEntitlements(['de.frankfleige.phpunit.sample3.1', 'de.frankfleige.phpunit.sample3.2']));
        $k = $b->getEntitlements();
        $this::assertInternalType("array", $k);
        $this::assertCount(2, $k);
    }

    /**
     * @covers B::isEntitledTo()
     */
    public function testIsEntitledTo() {
        $b = new B($this->getMockedInstanceWithEntitlements([]));
        $this::assertFalse($b->isEntitledTo('de.frankfleige.phpunit.sample3.1'));
        $b = new B($this->getMockedInstanceWithEntitlements(['de.frankfleige.phpunit.sample3.1', 'de.frankfleige.phpunit.sample3.2']));
        $this::assertFalse($b->isEntitledTo('de.frankfleige.phpunit.sample3.3'));
        $this::assertTrue($b->isEntitledTo('de.frankfleige.phpunit.sample3.2'));
        $this::assertTrue($b->isEntitledTo('de.frankfleige.phpunit.sample3.1'));
    }
}
