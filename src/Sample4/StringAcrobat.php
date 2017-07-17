<?php

namespace FrankFleige\PHPUnitPlayground\Sample4;

/**
 * Class StringAcrobat
 * The string acrobat is a helper class (model)
 * @package FrankFleige\PHPUnitPlayground\Sample4
 */
class StringAcrobat
{
    /**
     * Returns a random char
     * @return string
     */
    public function getRandomChar()
    {
        $alphabet = array_merge(range("0","9"), range("a", "z"), range("A", "Z"));
        shuffle($alphabet);
        return $alphabet[0];
    }
}