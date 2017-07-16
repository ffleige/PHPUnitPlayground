<?php
/**
 * Created by PhpStorm.
 * User: frankfleige
 * Date: 15.07.17
 * Time: 23:01
 */

namespace FrankFleige\PHPUnitPlayground\Sample2;


use FrankFleige\PHPUnitPlayground\Sample2\factory\PetFactory;
use FrankFleige\PHPUnitPlayground\Sample2\model\Pet;
use Guzzle\Http\Client;

class PetService
{
    /**
     * @var Client
     * @Inject
     */
    private $client;

    /**
     * @var PetFactory
     */
    private $petFactory;

    function __construct(Client $client, PetFactory $petFactory)
    {
        $this->client = $client;
        $this->petFactory = $petFactory;
    }

    /**
     * @return Pet[]
     */
    public function getSoldPets()
    {
        $response = $this->client->get('pet/findByStatus?status=sold', ['accept' => 'application/json'])->send();
        if ($response->getStatusCode() !== 200) {
            throw new \RuntimeException("http request failed with status code {$response->getStatusCode()}!");
        }
        $json = $response->getBody(true);
        return $this->petFactory->createFromJSON($json);
    }
}