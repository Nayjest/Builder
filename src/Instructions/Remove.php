<?php
namespace Nayjest\Builder\Instructions;

use Nayjest\Builder\Instructions\Base\Instruction;
use Nayjest\Builder\Scaffold;

/**
 * Class Remove
 *
 * @package Nayjest\Builder\Instructions
 */
class Remove extends Instruction
{
    /**
     * @var string field for removing
     */
    protected $input_name;

    /**
     * @param string $input_name field for removing
     */
    public function __construct($input_name)
    {
        $this->input_name = $input_name;
    }

    public function apply(Scaffold $scaffold)
    {
        if (array_key_exists($this->input_name, $scaffold->input)) {
            $scaffold->excludeInput($this->input_name);
        }
    }

}
