<?php

namespace Nayjest\Builder\Test\Instructions;

use Nayjest\Builder\Instructions\SimpleValueAsField;
use Nayjest\Builder\Scaffold;
use PHPUnit_Framework_TestCase;

class SimpleValueAsFieldTest extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $value = 42;
        $s = new Scaffold();
        $s->input = $value;
        $i = new SimpleValueAsField('test');
        $i->apply($s);
        $this->assertEquals(
            $value,
            $s->getInput('test')
        );
    }
} 