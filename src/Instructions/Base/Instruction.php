<?php
namespace Nayjest\Builder\Instructions\Base;

use Nayjest\Builder\Scaffold;

/**
 * Class Instruction
 *
 * Base class for build instructions.
 *
 * @package Nayjest\Builder\Instructions\Base
 */
abstract class Instruction implements InstructionInterface
{
    const PHASE_PRE_INST = 0;
    const PHASE_POST_INST = 1;
    const PHASE_FINAL = 2;

    protected $phase = self::PHASE_POST_INST;

    /**
     * Applies instruction.
     *
     * @param Scaffold $scaffold
     */
    abstract public function apply(Scaffold $scaffold);

    /**
     * Returns build phase when instruction must be applied.
     *
     * @return int
     */
    public function getBuildPhase()
    {
        return $this->phase;
    }

    /**
     * Sets build phase for instruction.
     *
     * @param int $phase
     * @return $this
     */
    public function setBuildPhase($phase)
    {
        $this->phase = $phase;
        return $this;
    }
}
