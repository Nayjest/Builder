<?php
namespace Nayjest\Builder\Instructions\Mapping\Base;

use Nayjest\Builder\Instructions\Base\InstructionInterface;

interface MappingInterface extends InstructionInterface
{
    /**
     * @param string $input_name
     * @return bool
     */
    public function isTargetInput($input_name);

    /**
     * @return bool
     */
    public function isExclusive();
}