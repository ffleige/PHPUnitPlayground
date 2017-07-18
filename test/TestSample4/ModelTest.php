<?php

namespace FrankFleige\PHPUnitPlayground\Test\TestSample4;

use FrankFleige\PHPUnitPlayground\Sample4\Model;
use PHPUnit\Framework\TestCase;

class ModelTest extends TestCase
{
    public function testGetShortUrl()
    {
        $m = new Model("test.de", "8080", "1234567890");
        $this->assertEquals("http://test.de:8080/1234567890", $m->getShortURL());
    }
}
