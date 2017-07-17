<?php

namespace FrankFleige\PHPUnitPlayground\Sample4;

/**
 * Class Model
 * This model computes really hard stuff
 * @package FrankFleige\PHPUnitPlayground\Sample4
 */
class Model
{
    private $protocol = "http";
    private $host;
    private $port;
    private $id;

    public function __construct(string $host, string $port, string $id)
    {
        $this->host = $host;
        $this->port = $port;
        $this->id = $id;
    }

    /**
     * returns a short url
     * @return string
     */
    public function getShortURL()
    {
        return "{$this->protocol}://{$this->host}:{$this->port}/{$this->id}";
    }



}