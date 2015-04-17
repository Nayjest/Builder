<?php
namespace Nayjest\Builder\Instructions\Mapping;

use Nayjest\Builder\Instructions\Base\Instruction;
use Nayjest\Builder\Instructions\Mapping\Base\Mapping;
use Nayjest\Builder\Scaffold;

/**
 * Class ConstructorArgument
 *
 * Instructions order is important here. It defines number of arg
 *
 * @package Nayjest\Builder\Instructions\Mapping
 */
class ConstructorArgument extends Mapping
{
    protected $phase = Instruction::PHASE_PRE_INST;

    protected $is_exclusive = true;

    /**
     * Constructor.
     *
     * @param string $input_name
     * @param null $default
     */
    public function __construct($input_name, $default = null)
    {
        $this->input_name = $input_name;
        $this->default = $default;
    }

    /**
     * {@inheritdoc}
     */
    public function applyInternal($value, Scaffold $scaffold)
    {
        $scaffold->constructor_arguments[] = $value;
    }
}
