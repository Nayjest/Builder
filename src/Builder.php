<?php
namespace Nayjest\Builder;

use Nayjest\Builder\Instructions\Base\Instruction;

class Builder
{
    /** @var Blueprint $blueprint */
    protected $blueprint;

    public function __construct(Blueprint $blueprint)
    {
        $this->setBlueprint($blueprint);
    }

    /**
     * @param array|mixed $input
     * @return mixed
     */
    public function build($input)
    {
        $scaffold = new Scaffold();
        $scaffold->class = $this->blueprint->class;
        $scaffold->input = $input;
        $this->applyInstructions($scaffold, Instruction::PHASE_PRE_INST);
        $this->makeInstance($scaffold);
        $this->applyInstructions($scaffold, Instruction::PHASE_POST_INST);
        $this->assignProperties($scaffold);
        $this->applyInstructions($scaffold, Instruction::PHASE_FINAL);
        return $scaffold->instance;
    }

    protected function applyInstructions(Scaffold $scaffold, $phase)
    {
        $instructions = $this->blueprint->getInstructions($phase);
        foreach ($instructions as $instruction) {
            $instruction->apply($scaffold);
        }
    }

    protected function makeInstance(Scaffold $scaffold)
    {

        $scaffold->instance = ClassUtils::instantiate(
            $scaffold->class,
            $scaffold->constructor_arguments
        );
    }

    protected function assignProperties(Scaffold $scaffold)
    {
        $scaffold->properties = array_merge(
            $scaffold->input,
            $scaffold->properties
        );
        ClassUtils::assign(
            $scaffold->instance,
            $scaffold->properties
        );
    }

    /**
     * @return mixed
     */
    public function getBlueprint()
    {
        return $this->blueprint;
    }

    /**
     * @param mixed $blueprint
     */
    public function setBlueprint(Blueprint $blueprint)
    {
        $this->blueprint = $blueprint;
    }
}