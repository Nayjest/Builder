<?php
namespace Nayjest\Builder;

use Nayjest\Builder\Instructions\Base\Instruction;
use mp;

/**
 * Class Builder
 *
 * Instances of this class are responsible
 * for building objects of certain type specified by blueprint.
 *
 * @package Nayjest\Builder
 */
class Builder
{
    /** @var Blueprint $blueprint */
    protected $blueprint;

    /**
     * @param Blueprint $blueprint
     */
    public function __construct(Blueprint $blueprint)
    {
        $this->setBlueprint($blueprint);
    }

    /**
     * Builds class instance based on input configuration.
     *
     * @param array|mixed $input
     * @return mixed
     */
    public function build($input)
    {
        $scaffold = new Scaffold($this->blueprint->class, $input);
        $this->applyInstructions($scaffold, Instruction::PHASE_PRE_INST);
        $this->makeInstance($scaffold);
        $this->applyInstructions($scaffold, Instruction::PHASE_POST_INST);
        $this->assignProperties($scaffold);
        $this->applyInstructions($scaffold, Instruction::PHASE_FINAL);
        return $scaffold->instance;
    }

    /**
     * Applies to scaffold all build instructions
     * that have specified build phase.
     *
     * @param Scaffold $scaffold
     * @param int $phase
     */
    protected function applyInstructions(Scaffold $scaffold, $phase)
    {
        $instructions = $this->blueprint->getInstructions($phase);
        foreach ($instructions as $instruction) {
            $instruction->apply($scaffold);
        }
    }

    /**
     * Creates target class instance.
     *
     * @param Scaffold $scaffold
     */
    protected function makeInstance(Scaffold $scaffold)
    {

        $scaffold->instance = mp\instantiate(
            $scaffold->class,
            $scaffold->constructor_arguments
        );
    }

    /**
     * Assigns public properties
     * and properties with setters to target class instance.
     *
     * @param Scaffold $scaffold
     */
    protected function assignProperties(Scaffold $scaffold)
    {
        $scaffold->properties = array_merge(
            $scaffold->input,
            $scaffold->properties
        );
        mp\setValues(
            $scaffold->instance,
            $scaffold->properties
        );
    }

    /**
     * Returns builder's blueprint.
     *
     * @return Blueprint
     */
    public function getBlueprint()
    {
        return $this->blueprint;
    }

    /**
     * Sets blueprint to builder.
     *
     * @param Blueprint $blueprint
     */
    public function setBlueprint(Blueprint $blueprint)
    {
        $this->blueprint = $blueprint;
    }
}
