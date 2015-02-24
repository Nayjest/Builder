<?php
namespace Nayjest\Builder;

use Nayjest\Builder\Instructions\Base\InstructionInterface;

class Blueprint
{
    /** @var  string */
    public $class;
    /** @var InstructionInterface[] */
    public $instructions = [];

    /**
     * @param string $class
     * @param InstructionInterface[] $instructions
     */
    public function __construct($class, array $instructions = [])
    {
        $this->class = $class;
        $this->instructions = $instructions;
    }

    /**
     * @param int $build_phase
     * @return InstructionInterface[]
     */
    public function getInstructions($build_phase)
    {
        $required = [];
        foreach ($this->instructions as $instruction) {
            if ($instruction->getBuildPhase() === $build_phase) {
                $required[] = $instruction;
            }
        }
        return $required;
    }
}