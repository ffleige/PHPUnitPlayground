<?php
/**
 * Created by PhpStorm.
 * User: frankfleige
 * Date: 15.07.17
 * Time: 12:23
 */

namespace FrankFleige\PHPUnitPlayground\Base;

/**
 * Class A
 * @package FrankFleige\PHPUnitPlayground\Testcase1
 */
class A
{
    /**
     * the name provider
     * @var B
     * @Inject
     */
    private $nameProvider;

    /**
     * A constructor.
     * @param B|null $nameProvider class that will provide the random name
     */
    public function __construct(B $nameProvider)
    {
        $this->nameProvider = $nameProvider;
    }

    /**
     * will say "hello" to a randomly chosen person!
     * @return string
     */
    public function sayBadHello() {
        //
        // this is bad, because we will not be able to unit test A only while mocking B 
        //
        $b = new B();
        return "Hello " . $b->getName();
    }

    /**
     * will say "hello" to a randomly chosen person!
     * @return string
     */
    public function sayBetterHello() {
        //
        // better: class B is called within it's own method.
        // So we could mock this method when unit testing A!
        //
        return "Hello " . $this->getName();
        
    }

    /**
     * will say "hello" to a randomly chosen person!
     * @return string
     */
    public function sayBestHello() {
        //
        // best: B is a dependency and provided when A is created.
        // So we can mock the entire class B!
        //
        return "Hello " . $this->nameProvider->getName();
    }
    
    /**
     * will get a random name from B
     * @return string
     */
    public function getName() {
        $b = new B();
        return $b->getName();
    }
    
}