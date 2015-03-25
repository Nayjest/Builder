<?php
namespace Nayjest\Builder\Test\Instructions;

use Nayjest\Builder\Instructions\CustomInstruction;
use Nayjest\Builder\Scaffold;
use PHPUnit_Framework_TestCase;

class CustomInstructionTest extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $s1 = new Scaffold(null, ['field' => 3]);
        $i = new CustomInstruction(function (Scaffold $s) {
            $s->input['field'] *= 2;
        });
        $i->apply($s1);
        $this->assertEquals(6, $s1->getInput('field'));
    }
}
