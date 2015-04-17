<?php
namespace Nayjest\Builder\Instructions\Base;

use Nayjest\Builder\Scaffold;

/**
 * Interface InstructionInterface
 *
 * Interface of build instructions.
 *
 * @package Nayjest\Builder\Instructions\Base
 */
interface InstructionInterface
{
    /**
     * Applies instruction.
     *
     * @param Scaffold $scaffold
     */
    public function apply(Scaffold $scaffold);

    /**
     * Returns build phase when instruction must be applied.
     *
     * @return int
     */
    public function getBuildPhase();
}
