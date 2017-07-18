<?php

namespace FrankFleige\PHPUnitPlayground\Test\TestSample4;

use FrankFleige\PHPUnitPlayground\Sample4\StringAcrobat;
use PHPUnit\Framework\TestCase;

class StringAcrobatTest extends TestCase
{

    public function testGetRandomChar()
    {
        $sa = new StringAcrobat();
        $this->assertEquals(1, strlen($sa->getRandomChar()));
        $this->assertTrue(is_string($sa->getRandomChar()));
        $alphabetCorrect = range("!", "z");
        $this->assertTrue(in_array($sa->getRandomChar(), $alphabetCorrect));
        $alphabetWrong = ["ä", "ö", "ü", "ß", "Ä", "Ü", "Ö"];
        $this->assertFalse(in_array($sa->getRandomChar(), $alphabetWrong));
    }
}
