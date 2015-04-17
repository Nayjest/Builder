<?php
namespace Nayjest\Builder\Instructions\Mapping;

use Nayjest\Builder\Instructions\Base\Instruction;
use Nayjest\Builder\Instructions\Mapping\Base\Mapping;
use Nayjest\Builder\Scaffold;

/**
 * Class Rename
 *
 * This class is a build instruction that can be used in class blueprints.
 *
 * Instruction moves field <old_name> to <new_name>.
 *
 * @package Nayjest\Builder\Instructions\Mapping
 */
class Rename extends Mapping
{
    protected $phase = Instruction::PHASE_PRE_INST;

    protected $is_exclusive = true;

    protected $new_name;

    /**
     * Constructor.
     *
     * @param string $oldName old field name
     * @param string $newName new field name
     */
    public function __construct($oldName, $newName)
    {
        $this->input_name = $oldName;
        $this->new_name = $newName;
    }

    /**
     * {@inheritdoc}
     */
    public function applyInternal($value, Scaffold $scaffold)
    {
        $scaffold->input[$this->new_name] = $value;
    }
}
