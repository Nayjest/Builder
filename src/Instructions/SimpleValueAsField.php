<?php
namespace Nayjest\Builder\Instructions;

use Nayjest\Builder\Instructions\Base\Instruction;
use Nayjest\Builder\Scaffold;

/**
 * Class SimpleValueAsField
 *
 * This class is a build instruction that can be used in class blueprints.
 *
 * Instruction converts non-array value used as input
 * into array containing mentioned value in corresponding field.
 *
 * Values that are instances of target class is ignored
 *
 * @package Nayjest\Builder\Instructions
 */
class SimpleValueAsField extends Instruction
{
    protected $phase = self::PHASE_PRE_INST;

    protected $field_name;

    /**
     * @param string $field_name Field where value will be placed
     */
    public function __construct($field_name)
    {
        $this->field_name = $field_name;
    }

    public function apply(Scaffold $scaffold)
    {
        if (!is_array($value = $scaffold->input)) {
            if (!is_object($value) && !is_a($value, $scaffold->class)) {
                $scaffold->input = [
                    $this->field_name => $value
                ];
            }
        }
    }
}
