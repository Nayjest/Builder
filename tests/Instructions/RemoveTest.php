<?php
namespace Nayjest\Builder\Test\Instructions;

use Nayjest\Builder\Instructions\Remove;
use Nayjest\Builder\Scaffold;
use PHPUnit_Framework_TestCase;

class RemoveTest extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $s1 = new Scaffold(null, []);
        $i = new Remove('field');
        # must be no exceptions
        $i->apply($s1);

        $s2 = new Scaffold(null, ['field' => 1]);
        $this->assertEquals(1, $s2->getInput('field'));
        $i->apply($s2);
        $this->assertEquals(null, $s2->getInput('field'));
    }
}
