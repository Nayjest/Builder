<?php
namespace Nayjest\Builder\Instructions;

use Nayjest\Builder\Instructions\Base\Instruction;
use Nayjest\Builder\Scaffold;

/**
 * Class SetValue
 *
 * This class is a build instruction that can be used in class blueprints.
 *
 * Instruction sets specified field value into input.
 * May be used with $overwrite = false to provide default values
 * or $overwrite = true to forced rewrite.
 *
 * @package Nayjest\Builder\Instructions
 */
class SetValue extends Instruction
{
    protected $phase = Instruction::PHASE_PRE_INST;
    protected $input_name;
    protected $value;
    protected $overwrite;

    /**
     * Constructor.
     *
     * @param string $input_name
     * @param mixed $value
     * @param bool $overwrite
     */
    public function __construct($input_name, $value, $overwrite = true)
    {
        $this->input_name = $input_name;
        $this->value = $value;
        $this->overwrite = $overwrite;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(Scaffold $scaffold)
    {
        if (!$this->overwrite && $scaffold->getInput($this->input_name)) {
            return;
        }
        $scaffold->input[$this->input_name] = $this->value;
    }

}
