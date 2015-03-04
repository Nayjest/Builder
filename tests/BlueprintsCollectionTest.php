<?php

namespace Nayjest\Builder\Test;

use Nayjest\Builder\Blueprint;
use Nayjest\Builder\BlueprintsCollection;
use PHPUnit_Framework_TestCase;

class BlueprintsCollectionTest extends PHPUnit_Framework_TestCase
{



    protected function setUp()
    {

    }

    public function testInstantiate()
    {
        $collection = new BlueprintsCollection();
        return $collection;
    }

    /**
     * @depends testInstantiate
     * @param BlueprintsCollection $c
     * @return mixed
     */
    public function testAdd(BlueprintsCollection $c)
    {   $a = 'Nayjest\Builder\Test\Mock\A';

        $res = $c->add(new Blueprint($a));
        $this->assertEquals($c, $res);
        return $c;
    }

    /**
     * @depends testInstantiate
     * @param BlueprintsCollection $c
     * @return mixed
     */
    public function testGetFor(BlueprintsCollection $c)
    {
        $a = 'Nayjest\Builder\Test\Mock\A';
        $b = 'Nayjest\Builder\Test\Mock\B';
        $res = $c->getFor($a, true);
        $this->assertEquals($res->class, $a);
        $res = $c->getFor($a, false);
        $this->assertEquals($res->class, $a);

        $res = $c->getFor($b, true);
        $this->assertEquals($res, null);

        $res = $c->getFor($b, false);
        $this->assertEquals($res->class, $a);

        $c->add(new Blueprint($b));
        $res = $c->getFor($b, true);
        $this->assertEquals($res->class, $b);
        $res = $c->getFor($b, false);
        $this->assertEquals($res->class, $b);

        $res = $c->getFor('NotExistant', false);
        $this->assertEquals($res, null);
        $res = $c->getFor('NotExistant', true);
        $this->assertEquals($res, null);

        $c->add(new Blueprint('NotExistant'));
        $res = $c->getFor('NotExistant', false);
        $this->assertEquals($res->class, 'NotExistant');

        $res = $c->getFor('NotExistant', true);
        $this->assertEquals($res->class, 'NotExistant');

        return $c;
    }



} 