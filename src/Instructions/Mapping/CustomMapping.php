<?php
namespace Nayjest\Builder\Instructions\Mapping;


use Nayjest\Builder\Instructions\Base\Instruction;
use Nayjest\Builder\Instructions\Mapping\Base\Mapping;
use Nayjest\Builder\Scaffold;

class CustomMapping extends Mapping
{
    protected $fn;

    public function __construct(
        $input_name,
        $fn,
        $phase = Instruction::PHASE_POST_INST,
        $is_exclusive = true
    ) {
        $this->input_name = $input_name;
        $this->fn = $fn;
        $this->phase = $phase;
        $this->is_exclusive = $is_exclusive;
    }

    public function applyInternal($value, Scaffold $scaffold)
    {
        call_user_func($value, $scaffold);
    }
}