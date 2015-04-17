<?php
namespace Nayjest\Builder\Instructions\Mapping;

use Nayjest\Builder\Instructions\Base\Instruction;
use Nayjest\Builder\Instructions\Mapping\Base\Mapping;
use Nayjest\Builder\Scaffold;

/**
 * Class Method
 *
 * This class is a build instruction that can be used in class blueprints.
 *
 * Instruction calls specified method from target class instance
 * with value of specified input field as argument.
 *
 * @package Nayjest\Builder\Instructions\Mapping
 */
class CallMethodWith extends Mapping
{
    protected $phase = Instruction::PHASE_POST_INST;

    protected $is_exclusive = true;

    protected $method;

    /**
     * Constructor.
     *
     * @param string $inputName
     * @param string $methodName
     */
    public function __construct($inputName, $methodName)
    {
        $this->input_name = $inputName;
        $this->method = $methodName;
    }

    /**
     * {@inheritdoc}
     */
    public function applyInternal($value, Scaffold $scaffold)
    {
        call_user_func([$scaffold->instance, $this->method], $value);
    }
}
