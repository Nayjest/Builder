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
            if ($this->is_exclusive) {
                $scaffold->excludeInput($this->input_name);
            }
            $this->applyInternal($value, $scaffold);
        } elseif(null !== $this->default) {
            $this->applyInternal($this->default, $scaffold);
        }
    }

    /**
     * @param mixed $default
     * @return $this
     */
    public function setDefault($default)
    {
        $this->default = $default;
        return $this;
    }

    /**
     * @param bool $is_exclusive
     * @return $this
     */
    public function setExclusive($is_exclusive)
    {
        $this->is_exclusive = $is_exclusive;
        return $this;
    }

    /**
     * @param string $input_name
     * @return $this
     */
    public function setInputName($input_name)
    {
        $this->input_name = $input_name;
        return $this;
    }
}