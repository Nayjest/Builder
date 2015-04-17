<?php
namespace Nayjest\Builder\Instructions\Mapping;

use Nayjest\Builder\Instructions\Base\Instruction;
use Nayjest\Builder\Instructions\Mapping\Base\Mapping;
use Nayjest\Builder\Scaffold;

class ClassName extends Mapping
{
    protected $phase = Instruction::PHASE_PRE_INST;

    protected $is_exclusive = true;

    /**
     * Constructor.
     *
     * @param $input_name
     */
    public function __construct($input_name)
    {
        $this->input_name = $input_name;
    }

    /**
     * {@inheritdoc}
     */
    public function applyInternal($value, Scaffold $scaffold)
    {
        $scaffold->class = $value;
    }
}
