<?php
namespace Nayjest\Builder\Instructions\Mapping\Base;

use Nayjest\Builder\Instructions\Base\InstructionInterface;

/**
 * Interface MappingInterface
 *
 * Interface of mapping build instructions.
 *
 * @package Nayjest\Builder\Instructions\Mapping\Base
 */
interface MappingInterface extends InstructionInterface
{
    /**
     * Returns true if mapping instruction is designed for specified field.
     *
     * @param string $input_name
     * @return bool
     */
    public function isTargetInput($input_name);

    /**
     * Returns true if mapping is exclusive.
     * Exclusivity means that processed value will be removed from input array.
     *
     * @return bool
     */
    public function isExclusive();
}
