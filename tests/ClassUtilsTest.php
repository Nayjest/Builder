<?php

namespace Nayjest\Builder\Test;

use Nayjest\Builder\ClassUtils;
use Nayjest\Builder\Test\Mock\PersonStruct;
use PHPUnit_Framework_TestCase;

class ClassUtilsTest extends PHPUnit_Framework_TestCase
{



    protected function setUp()
    {

    }

    public function testInstantiateWithoutArguments()
    {
        $class = 'Nayjest\Builder\Test\Mock\PersonStruct';
        $class2 = '\Nayjest\Builder\Test\Mock\PersonStruct';

        $person = ClassUtils::instantiate($class);
        $this->assertInstanceOf($class, $person);
        $this->assertInstanceOf($class2, $person);


        $person = ClassUtils::instantiate($class);
        $this->assertInstanceOf($class2, $person);
        $this->assertInstanceOf($class, $person);

        return $person;
    }


    /**
     * @depends testInstantiateWithoutArguments
     * @param PersonStruct $person
     * @return PersonStruct
     */
    public function testAssignPublicProperties(PersonStruct $person)
    {
        $assigned = ClassUtils::assignPublicProperties($person, [
            'name' => 'John',
            'age' => 27,
        ]);
        $this->assertEquals(27, $person->age);
        $this->assertEquals('John', $person->name);
        $this->assertEquals(serialize($assigned), serialize(['name','age']));
        return $person;
    }

    /**
     * @depends testInstantiateWithoutArguments
     * @param PersonStruct $person
     * @return PersonStruct
     */
    public function testAssignNonExistentProperties(PersonStruct $person)
    {
        $assigned = ClassUtils::assignPublicProperties($person, [
            'nonExistentProp' => 'test',
        ]);
        $this->assertEmpty($assigned);
        $this->assertFalse(property_exists($person,'nonExistentProp'));
        return $person;
    }

    /**
     * @depends testInstantiateWithoutArguments
     * @param PersonStruct $person
     * @return PersonStruct
     */
    public function testAssignUsingSetters(PersonStruct $person)
    {
        $email = 'me@example.com';
        $assigned = ClassUtils::assignBySetters(
            $person,
            compact('email')
        );
        $this->assertEquals($email, $person->getEmail());
        $this->assertArrayHasKey('email', array_flip($assigned));
        $this->assertEquals(count($assigned), 1);
        return $person;
    }

    /**
     * @depends testInstantiateWithoutArguments
     * @param PersonStruct $person
     * @return PersonStruct
     */
    public function testAssignMixed(PersonStruct $person)
    {
        $email = 'me2@example.com';
        $someProp = 'test';
        $gender = 'm';

        $assigned = ClassUtils::assign(
            $person,
            compact('email', 'someProp', 'gender')
        );
        $this->assertEquals($email, $person->getEmail());
        $this->assertEquals($gender, $person->gender);
        $this->assertFalse(property_exists($person,'someProp'));
        $this->assertEquals(count($assigned), 2);
        return $person;
    }

    public function testConArgs()
    {
        $class = 'Nayjest\Builder\Test\Mock\ConArgs';
        $inst = ClassUtils::instantiate($class, ['a', 'b']);
        $this->assertEquals('a!a', $inst->a);
        $this->assertEquals('b!b', $inst->b);
    }

} 