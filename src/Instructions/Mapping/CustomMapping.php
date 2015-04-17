<?php
namespace Nayjest\Builder\Instructions\Mapping;

use Nayjest\Builder\Instructions\Base\Instruction;
use Nayjest\Builder\Instructions\Mapping\Base\Mapping;
use Nayjest\Builder\Scaffold;

/**
 * Class CustomMapping
 *
 * This class is a build instruction that can be used in class blueprints.
 *
 * Instruction applies user function specified in constructor to specified input field inside Scaffold object.
 *
 * @package Nayjest\Builder\Instructions\Mapping
 */
class CustomMapping extends Mapping
{
    protected $function;

    /**
     * Constructor.
     *
     * @param string $input_name
     * @param \Closure $function arg1 = input value, arg2 = scaffold
     * @param mixed $default If input has no specified field but default option is not empty, user function will be called with default value
     * @param int $phase
     * @param bool $is_exclusive true by default
     */
    public function __construct(
        $input_name,
        $function,
        $default = null,
        $phase = Instruction::PHASE_POST_INST,
        $is_exclusive = true
    )
    {
        $this->input_name = $input_name;
        $this->function = $function;
        $this->default = $default;
        $this->phase = $phase;
        $this->is_exclusive = $is_exclusive;
    }

    /**
     * {@inheritdoc}
     */
    public function applyInternal($value, Scaffold $scaffold)
    {
        call_user_func($this->function, $value, $scaffold);
    }
}
