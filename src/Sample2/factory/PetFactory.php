<?php
/**
 * Created by PhpStorm.
 * User: frankfleige
 * Date: 16.07.17
 * Time: 11:29
 */

namespace FrankFleige\PHPUnitPlayground\Sample2\factory;

use FrankFleige\PHPUnitPlayground\Sample2\model\Category;
use FrankFleige\PHPUnitPlayground\Sample2\model\Pet;
use FrankFleige\PHPUnitPlayground\Sample2\model\Tag;

class PetFactory
{
    /**
     * singleton instance of the pet factory
     * @var PetFactory
     */
    private static $instance;

    /**
     * will return the singleton instance of the pet factory
     * @return PetFactory
     */
    public static function getInstance()
    {
        if (!static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * will create pet objects from a JSON response
     * @param string $json raw JSON
     * @return Pet[]
     */
    public function createFromJSON($json)
    {
        $items = json_decode($json, true);
        $return = [];
        foreach ($items as $petData) {
            $pet = new Pet(
                $petData['id'],
                new Category($petData['category']['id'], $petData['category']['name']),
                $petData['name'],
                $petData['photoUrls'],
                [],
                $petData['status']
            );
            $tags = [];
            foreach ($petData['tags'] as $tagData) {
                $tags[] = new Tag($tagData['id'], $tagData['name']);
            }
            $pet->setTags($tags);
            $return[] = $pet;
        }
        return $return;
    }
}