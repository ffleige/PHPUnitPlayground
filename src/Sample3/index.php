<?php
/**
 * Created by PhpStorm.
 * User: frankfleige
 * Date: 17.07.17
 * Time: 14:37
 */

use DI\ContainerBuilder;

require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

// A
$a = new \FrankFleige\PHPUnitPlayground\Sample3\A1();
$a->initEntitlements();
var_dump($a->getEntitlements());

// B
$containerBuilder = new ContainerBuilder();
/** @noinspection PhpUnusedParameterInspection */
$containerBuilder->addDefinitions(
    [
        \FrankFleige\PHPUnitPlayground\Sample3\C::class => function(ContainerBuilder $c) {
            return \FrankFleige\PHPUnitPlayground\Sample3\C::getInstance();
        }
    ]
);
$container = $containerBuilder->build();
$b = $container->get('FrankFleige\PHPUnitPlayground\Sample3\B');
var_dump($b->getEntitlements());
