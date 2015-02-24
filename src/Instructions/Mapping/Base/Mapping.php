<?php
namespace Nayjest\Builder\Instructions\Mapping\Base;

use Nayjest\Builder\Instructions\Base\Instruction;
use Nayjest\Builder\Scaffold;

abstract class Mapping extends Instruction implements MappingInterface
{

    protected $input_name;

    protected $is_exclusive = true;

    public function isTargetInput($input_name)
    {
        return $input_name === $this->input_name;
    }

    public function isExclusive()
    {
        return $this->is_exclusive;
    }

    abstract protected function applyInternal($value, Scaffold $scaffold);

    public function apply(Scaffold $scaffold)
    {
        $value = $scaffold->getInput($this->input_name);
        if (null !== $value) {
            $this->applyInternal($value, $scaffold);
            if ($this->is_exclusive) {
                $scaffold->excludeInput($this->input_name);
            }
        }
    }
}