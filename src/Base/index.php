<?php
/**
 * Created by PhpStorm.
 * User: frankfleige
 * Date: 15.07.17
 * Time: 21:59
 */
use DI\ContainerBuilder;

require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

$container = ContainerBuilder::buildDevContainer();
$a = $container->get('FrankFleige\PHPUnitPlayground\Base\A');
echo $a->sayBestHello() . "!";