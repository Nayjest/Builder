<?php
namespace Nayjest\Builder\Instructions\Base;


use Nayjest\Builder\Scaffold;

abstract class Instruction implements InstructionInterface
{
    const PHASE_PRE_INST = 0;
    const PHASE_POST_INST = 1;
    const PHASE_FINAL = 2;

    protected $phase = self::PHASE_POST_INST;

    abstract public function apply(Scaffold $scaffold);

    /**
     * @return int
     */
    public function getBuildPhase()
    {
        return $this->phase;
    }
}