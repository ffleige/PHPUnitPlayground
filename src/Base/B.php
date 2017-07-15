<?php
/**
 * Created by PhpStorm.
 * User: frankfleige
 * Date: 15.07.17
 * Time: 12:23
 */

namespace FrankFleige\PHPUnitPlayground\Base;

/**
 * Class B
 * @package FrankFleige\PHPUnitPlayground\Testcase1
 */
class B
{
    /**
     * will return a random name
     * @return string
     */
    public function getName() {
        $names = ['Frank', 'Daniela', 'Constantin', 'Timo', 'Anja', 'Edith'];
        $i = random_int(0,count($names)-1);
        return $names[$i];
    }
}