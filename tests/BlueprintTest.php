<?php

namespace Nayjest\Builder\Test;

use Nayjest\Builder\Blueprint;
use Nayjest\Builder\Instructions\Base\Instruction;
use Nayjest\Builder\Instructions\CustomInstruction;
use PHPUnit_Framework_TestCase;

class BlueprintTest extends PHPUnit_Framework_TestCase
{

    /** @var  Blueprint */
    protected $bp;

    /** @var CustomInstruction  */
    protected $instr1;

    /** @var CustomInstruction  */
    protected $instr2;

    protected function setUp()
    {
        $this->instr1 = new CustomInstruction(function(){}, Instruction::PHASE_FINAL);
        $this->instr2 = new CustomInstruction(function(){}, Instruction::PHASE_PRE_INST);
        $this->bp = new Blueprint('SomeClass', [
            $this->instr1
        ]);
    }
    public function test()
    {

        # test class inialization
        $this->assertEquals('SomeClass', $this->bp->class);

        # test getting instructions
        $this->assertTrue(in_array(
            $this->instr1,
            $this->bp->getInstructions(Instruction::PHASE_FINAL)
        ));
        $this->assertEmpty($this->bp->getInstructions(Instruction::PHASE_PRE_INST));

        # test adding instruction
        $this->bp->add($this->instr2);
        $this->assertTrue(in_array(
            $this->instr2,
            $this->bp->getInstructions(Instruction::PHASE_PRE_INST)
        ));

        $this->assertEmpty($this->bp->getInstructions(Instruction::PHASE_POST_INST));

        # test adding closure
        $fn = function(){};
        $this->bp->add($fn);
        $list = $this->bp->getInstructions(Instruction::PHASE_POST_INST);
        $instr = array_pop($list);
        $this->assertTrue($instr instanceof CustomInstruction);
    }
} 