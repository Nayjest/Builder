<?php
namespace Nayjest\Builder\Instructions\Mapping;
use Nayjest\Builder\Instructions\Base\Instruction;
use Nayjest\Builder\Instructions\Mapping\Base\Mapping;
use Nayjest\Builder\Scaffold;

class Rename extends Mapping
{
    protected $phase = Instruction::PHASE_PRE_INST;

    protected $is_exclusive = true;

    protected $new_name;

    public function __construct($from, $to)
    {
        $this->input_name = $from;
        $this->new_name = $to;
    }

    public function applyInternal($value, Scaffold $scaffold)
    {
        $scaffold->input[$this->new_name] = $value;
    }
}