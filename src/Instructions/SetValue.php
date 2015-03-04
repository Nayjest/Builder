<?php
namespace Nayjest\Builder\Instructions;

use Nayjest\Builder\Instructions\Base\Instruction;
use Nayjest\Builder\Scaffold;

/**
 * Class SetValue
 *
 * @package Nayjest\Builder\Instructions
 */
class SetValue extends Instruction
{
    protected $phase = Instruction::PHASE_PRE_INST;
    protected $input_name;
    protected $value;
    protected $overwrite;

    public function __construct($input_name, $value, $overwrite = true)
    {
        $this->input_name = $input_name;
        $this->value = $value;
        $this->overwrite = $overwrite;
    }

    public function apply(Scaffold $scaffold)
    {
        if (!$this->overwrite && $scaffold->getInput($this->input_name)) {
            return;
        }
        $scaffold->input[$this->input_name] = $this->value;
    }

}