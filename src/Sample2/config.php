<?php
use Interop\Container\ContainerInterface;

/** @noinspection PhpUnusedParameterInspection */
return [
    'api.baseurl' => 'http://petstore.swagger.io/v2/',
    'Guzzle\\Http\\Client' => function (ContainerInterface $c) {
        return new \Guzzle\Http\Client($c->get('api.baseurl'));
    },
    'FrankFleige\\PHPUnitPlayground\\Sample2\\factory\\PetFactory' =>
        function (ContainerInterface $c) {
            return \FrankFleige\PHPUnitPlayground\Sample2\factory\PetFactory::getInstance();
        }
];