<?php
namespace Nayjest\Builder\Instructions\Mapping;


use Nayjest\Builder\Instructions\Base\Instruction;
use Nayjest\Builder\Instructions\Mapping\Base\Mapping;
use Nayjest\Builder\Scaffold;

class CustomMapping extends Mapping
{
    protected $fn;

    /**
     * @param string $input_name
     * @param \Closure $fn arg1 = input value, arg2 = scaffold
     * @param mixed $default
     * @param int $phase
     * @param bool $is_exclusive true by default
     */
    public function __construct(
        $input_name,
        $fn,
        $default = null,
        $phase = Instruction::PHASE_POST_INST,
        $is_exclusive = true
    ) {
        $this->input_name = $input_name;
        $this->fn = $fn;
        $this->default = $default;
        $this->phase = $phase;
        $this->is_exclusive = $is_exclusive;
    }

    public function applyInternal($value, Scaffold $scaffold)
    {
        call_user_func($this->fn, $value, $scaffold);
    }
}