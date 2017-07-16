<?php
/**
 * Created by PhpStorm.
 * User: frankfleige
 * Date: 15.07.17
 * Time: 21:59
 */

// include autoloader
require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

$containerBuilder = new DI\ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . DIRECTORY_SEPARATOR . 'config.php');
$container = $containerBuilder->build();
/** @var \FrankFleige\PHPUnitPlayground\Sample2\PetService $ps */
$ps = $container->get('FrankFleige\\PHPUnitPlayground\\Sample2\\PetService');
var_dump($ps->getSoldPets());