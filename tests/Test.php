<?php

class Mock
{
    public $name;
}

class ConstructorMock
{
    public $field;

    public function __construct($val)
    {
        $this->field = $val;
    }
}

class ConstructorMock2
{
    public $field;

    public function __construct($val1, $val2, $val3, $val4 = "default")
    {
        $this->field = $val1 . $val2 . $val3 . $val4;
    }
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

    public function test_make_with_class_argument()
    {

        $instance = $this->facade->make([], 'Mock');
        $this->assertEquals('Mock', get_class($instance));
    }

    public function test_blueprint_public_properties()
    {

        $instance = $this->facade->make(['name' => 'John'], 'Mock');
        $this->assertEquals('John', $instance->name);
    }

    public function test_facade_registering_blueprint()
    {
        $this->facade->register([
            'class' => 'Mock',
            'defaults' => ['name' => 'defaultValue']
        ]);
        $instance1 = $this->facade->make([], 'Mock');
        $instance2 = $this->facade->make(['name' => 'Robert'], 'Mock');
        $this->assertEquals('defaultValue', $instance1->name);
        $this->assertEquals('Robert', $instance2->name);

    }
    public function test_constructor_arguments()
    {
        $this->facade->register([
            'class' => 'ConstructorMock',
            'asConstructorArguments' => ['test_argument1'],
            'defaults' => ['test_argument1' => 'value1']
        ]);

        $instance1 = $this->facade->make([], 'ConstructorMock');
        $instance2 = $this->facade->make(['test_argument1' => 'value2'], 'ConstructorMock');

        $this->assertEquals('value1', $instance1->field);
        $this->assertEquals('value2', $instance2->field);
    }

} 