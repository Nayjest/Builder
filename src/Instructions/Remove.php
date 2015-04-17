<?php
namespace Nayjest\Builder\Instructions;

use Nayjest\Builder\Instructions\Base\Instruction;
use Nayjest\Builder\Scaffold;

/**
 * Class Remove
 *
 * This class is a build instruction that can be used in class blueprints.
 *
 * Instruction removes specified field from input.
 *
 * @package Nayjest\Builder\Instructions
 */
class Remove extends Instruction
{
    protected $phase = self::PHASE_PRE_INST;

    /**
     * @var string field for removing
     */
    protected $input_name;

    /**
     * Constructor.
     *
     * @param string $input_name field for removing
     */
    public function __construct($input_name)
    {
        $this->input_name = $input_name;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(Scaffold $scaffold)
    {
        if (array_key_exists($this->input_name, $scaffold->input)) {
            $scaffold->excludeInput($this->input_name);
        }
    }

}
