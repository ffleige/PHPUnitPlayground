<?php

namespace FrankFleige\PHPUnitPlayground\Sample4;

/**
 * Class AppController
 * Runs the application
 * @package FrankFleige\PHPUnitPlayground\Sample4
 */
class AppController
{

    private $database;
    private $config;
    private $acrobat;

    public function __construct()
    {
        $this->database = new Database();
        $this->config = new ConfigurationRepository();
        $this->acrobat = new StringAcrobat();
    }

    /**
     * runs the app / runs the controller
     */
    public function run()
    {
        // take this model, all you need
        $model = new Model(
            $this->config->get("host"),
            $this->config->get("port"),
            $this->generateUniqueId());

        echo $model->getShortURL();
    }

    /**
     * Generates an unique id
     * @return string
     */
    private function generateUniqueId()
    {
        $id = "";
        do {
            $id .= $this->acrobat->getRandomChar();
        } while ($this->database->idExists($id));
        return $id;
    }
}