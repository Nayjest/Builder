<?php
namespace Nayjest\Builder\Instructions;

use Closure;
use Nayjest\Builder\Instructions\Base\Instruction;
use Nayjest\Builder\Scaffold;

class CustomInstruction extends Instruction
{
    protected $fn;

    public function __construct(Closure $fn, $phase = Instruction::PHASE_POST_INST)
    {
        $this->fn = $fn;
        $this->phase = $phase;
    }

    public function apply(Scaffold $scaffold)
    {
        return call_user_func($this->fn, $scaffold);
    }

}