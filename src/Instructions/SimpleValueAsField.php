<?php
namespace Nayjest\Builder\Instructions;

use Nayjest\Builder\Instructions\Base\Instruction;
use Nayjest\Builder\Scaffold;

class SimpleValueAsField extends Instruction
{
    protected $phase = self::PHASE_PRE_INST;

    protected $field_name;


    public function __construct($field_name)
    {
        $this->field_name = $field_name;
    }

    public function apply(Scaffold $scaffold)
    {
        if (!is_array($value = $scaffold->input)) {
            if (!is_object($value) and !is_a($value, $scaffold->class)) {
                $scaffold->input = [
                    $this->field_name => $value
                ];
            }
        }
    }

}