<?php

require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

$app = new \FrankFleige\PHPUnitPlayground\Sample4\AppController();
$app->run();