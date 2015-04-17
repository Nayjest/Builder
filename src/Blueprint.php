<?php
namespace Nayjest\Builder;

use Closure;
use Nayjest\Builder\Instructions\Base\InstructionInterface;
use Nayjest\Builder\Instructions\CustomInstruction;

/**
 * Class Blueprint
 *
 * Blueprints describes how to build objects of specified type.
 *
 * @package Nayjest\Builder
 */
class Blueprint
{
    /** @var  string */
    public $class;
    /** @var InstructionInterface[] */
    public $instructions = [];

    /**
     * Constructor.
     *
     * @param string $class Target class name
     * @param InstructionInterface[] $instructions
     */
    public function __construct($class, array $instructions = [])
    {
        $this->class = $class;
        $this->instructions = $instructions;
    }

    /**
     * Returns instructions for specified build phase.
     *
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

    /**
     * Adds instruction to blueprint.
     *
     * @param InstructionInterface|Closure $instruction
     * @return $this
     */
    public function add($instruction)
    {
        if ($instruction instanceof Closure) {
            $instruction = new CustomInstruction($instruction);
        }
        $this->instructions[] = $instruction;
        return $this;
    }
}
