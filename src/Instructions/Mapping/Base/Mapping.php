<?php
namespace Nayjest\Builder\Instructions\Mapping\Base;

use Nayjest\Builder\Instructions\Base\Instruction;
use Nayjest\Builder\Scaffold;

abstract class Mapping extends Instruction implements MappingInterface
{

    protected $input_name;

    /** @var bool Field will be removed from input true */
    protected $is_exclusive = true;

    protected $default;

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
        } elseif(null !== $this->default) {
            $this->applyInternal($this->default, $scaffold);
        }
    }
}