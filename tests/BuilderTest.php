<?php

namespace Nayjest\Builder\Test;

use Nayjest\Builder\Blueprint;
use Nayjest\Builder\Builder;
use Nayjest\Builder\Instructions\Mapping\ConstructorArgument;
use Nayjest\Builder\Instructions\Mapping\Rename;
use Nayjest\Builder\Test\Mock\ConArgs;
use Nayjest\Builder\Test\Mock\PersonStruct;
use PHPUnit_Framework_TestCase;

class BuilderTest extends PHPUnit_Framework_TestCase
{



    protected function setUp()
    {

    }

    public function testSetGetBlueprint()
    {
        $class = 'Nayjest\Builder\Test\Mock\PersonStruct';
        $blueprint1 = new Blueprint($class);
        $blueprint2 = new Blueprint($class, [new Rename('years_old', 'age')]);
        $builder = new Builder($blueprint1);
        $this->assertEquals($blueprint1, $builder->getBlueprint());
        $this->assertNotEquals($blueprint2, $builder->getBlueprint());
        $builder->setBlueprint($blueprint2);
        $this->assertEquals($blueprint2, $builder->getBlueprint());
    }

    public function testConstructorArguments()
    {
        $class = 'Nayjest\Builder\Test\Mock\ConArgs';
        $blueprint = new Blueprint($class, [
            new ConstructorArgument('a'),
            new ConstructorArgument('b', 'b'),
        ]);
        $builder = new Builder($blueprint);
        /** @var ConArgs $inst */
        $inst = $builder->build([
            'a' => 'a',
            # 'b' => 'b', default value from constr. arg.
            'c' => 'c!c',
            'd' => 'd'
        ]);

        $this->assertInstanceOf($class, $inst);
        $this->assertEquals('a!a', $inst->a);
        $this->assertEquals('b!b', $inst->b);
        $this->assertEquals('c!c', $inst->c);
        $this->assertEquals('d!d', $inst->getD());
    }

    public function testRename()
    {
        $class = 'Nayjest\Builder\Test\Mock\PersonStruct';
        $blueprint = new Blueprint($class, [
            new Rename('years_old', 'age')
        ]);
        $builder = new Builder($blueprint);
        /** @var PersonStruct $inst */
        $inst = $builder->build([
            'years_old' => 18
        ]);
        $this->assertEquals(18, $inst->age);
    }

    public function testDefaultBuild()
    {
        $class = 'Nayjest\Builder\Test\Mock\PersonStruct';
        $blueprint = new Blueprint($class);
        $builder = new Builder($blueprint);
        $cfg = [
            'name' => 'Jack',
            'email' => 'text@example.com',
            'gender' => 'm',
            'age' => 28,
            'unknown_option' => '77'
        ];
        /** @var  PersonStruct $inst */
        $inst = $builder->build($cfg);
        $this->assertInstanceOf($class, $inst);
        $this->assertEquals($inst->name, $cfg['name']);
        $this->assertEquals($inst->gender, $cfg['gender']);
        $this->assertEquals($inst->age, $cfg['age']);
        $this->assertEquals($inst->getEmail(), $cfg['email']);
    }


} 