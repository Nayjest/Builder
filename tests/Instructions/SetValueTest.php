<?php

namespace Nayjest\Builder\Test\Instructions;

use Nayjest\Builder\Instructions\SetValue;
use Nayjest\Builder\Scaffold;
use PHPUnit_Framework_TestCase;

class SetValueTest extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $s = new Scaffold();
        $i = new SetValue('field', 1, false);
        $i->apply($s);
        $this->assertEquals(
            1,
            $s->getInput('field'),
            'Test setting new value if empty inside input, overwrite = false'
        );

        $i = new SetValue('field2', 1, true);
        $i->apply($s);
        $this->assertEquals(
            1,
            $s->getInput('field2'),
            'Test setting new value if empty inside input, overwrite = true, result must be the same'
        );

        $i = new SetValue('field', 2, false);
        $i->apply($s);
        $this->assertEquals(1, $s->getInput('field'), 'Test overwrite = false');

        $i = new SetValue('field', 3, true);
        $i->apply($s);
        $this->assertEquals(3, $s->getInput('field'), 'Test overwrite = true');
    }
} 