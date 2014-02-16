<?php

class Mock
{
    public $name;
}

class Test extends PHPUnit_Framework_TestCase
{

    /**
     * @var Nayjest\Builder\Builder
     */
    protected $facade;

    protected function setUp()
    {
        $this->facade = new Nayjest\Builder\Builder();
    }

    public function test_construct_with_class()
    {

        $instance = $this->facade->make([], 'Mock');
        $this->assertEquals('Mock', get_class($instance));
    }

    public function test_public_properties()
    {

        $instance = $this->facade->make(['name' => 'John'], 'Mock');
        $this->assertEquals('John', $instance->name);
    }

} 