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
     * @param string $input_name
     * @return bool
     */
    public function isTargetInput($input_name);

    /**
     * If mapping is exclusive, processed value will be removed from input array.
     *
     * @return bool
     */
    public function isExclusive();
}
