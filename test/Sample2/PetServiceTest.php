<?php
/**
 * Created by PhpStorm.
 * User: frankfleige
 * Date: 16.07.17
 * Time: 00:35
 */

namespace FrankFleige\PHPUnitPlayground\Test\Sample2;

use FrankFleige\PHPUnitPlayground\Sample2\model\Category;
use FrankFleige\PHPUnitPlayground\Sample2\model\Pet;
use FrankFleige\PHPUnitPlayground\Sample2\factory\PetFactory;
use FrankFleige\PHPUnitPlayground\Sample2\PetService;
use Guzzle\Http\Client;
use Guzzle\Http\Message\Response;
use PHPUnit\Framework\TestCase;

class PetServiceTest extends TestCase
{

    /**
     * test with sold pets
     */
    public function testGetSoldPets()
    {
        /** @var PetFactory $petFactory */
        //
        // check with empty response
        //
        $petservice = $this->getPetServiceWithMocks(200, '[]', []);
        $result = $petservice->getSoldPets();
        $this->assertInternalType("array", $result, "check is array");
        //
        // check with one item in response
        //
        $mockedResponse = '[{"id": 1499957728790,"category": {"id": 0,"name": "dogs"},"name": "Bello",
        "photoUrls": ["http://www.hunde-fan.de/hundemarkt/wp-content/uploads/2016/03/Hunde-kaufen-verantwortung.jpg"],
        "tags": [{"id": 1,"name": "dog puppy"}],"status": "sold"}]';
        $pet = new Pet(1, new Category(0, ""), "", [], [], '');
        $petservice = $this->getPetServiceWithMocks(200, $mockedResponse, [$pet]);
        $result = $petservice->getSoldPets();
        $this::assertInternalType("array", $result, "check is array");
        $this::assertCount(1, $result);
        $this::assertInstanceOf(Pet::class, $result[0]);
    }

    /**
     * @param int $status http status code
     * @param string $mockedResponse raw JSON response
     * @param array $result array of pets that should be returned by the pet factory
     * @return PetService
     */
    private function getPetServiceWithMocks($status, $mockedResponse, $result)
    {
        $petFactory = $this->getMockBuilder(PetFactory::class)->setMethods(['createFromJSON'])->getMock();
        $petFactory->expects($this->once())->method('createFromJSON')->with($mockedResponse)->willReturn($result);
        /** @var PetFactory $petFactory */
        return new PetService($this->getMockedClientForGetSoldPets($status, $mockedResponse), $petFactory);
    }

    /**
     * @param int $status http status code
     * @param string $body raw http response body
     * @return \PHPUnit_Framework_MockObject_MockObject|Client
     */
    private function getMockedClientForGetSoldPets($status, $body)
    {
        $client = $this->getMockBuilder(Client::class)->setMethods(['send'])->getMock();
        $client->expects($this->once())
            ->method('send')
            ->willReturn(new Response($status, [], $body));
        return $client;
    }
}
