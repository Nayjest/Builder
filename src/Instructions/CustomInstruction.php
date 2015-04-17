<?php
namespace Nayjest\Builder\Instructions;

use Closure;
use Nayjest\Builder\Instructions\Base\Instruction;
use Nayjest\Builder\Scaffold;

/**
 * Class CustomInstruction
 *
 * This class is a build instruction that can be used in class blueprints.
 *
 * Instruction applies user function specified in constructor to Scaffold object
 *
 * @package Nayjest\Builder\Instructions
 */
class CustomInstruction extends Instruction
{
    protected $function;

    /**
     * Constructor.
     *
     * @param callable $function function to apply
     * @param int $phase
     */
    public function __construct(Closure $function, $phase = Instruction::PHASE_POST_INST)
    {
        $this->function = $function;
        $this->phase = $phase;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(Scaffold $scaffold)
    {
        return call_user_func($this->function, $scaffold);
    }

}
