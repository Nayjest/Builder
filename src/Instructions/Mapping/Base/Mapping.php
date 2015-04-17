<?php
namespace Nayjest\Builder\Instructions\Mapping\Base;

use Nayjest\Builder\Instructions\Base\Instruction;
use Nayjest\Builder\Scaffold;

/**
 * Class Mapping
 *
 * Base class for mapping build instructions.
 *
 * @package Nayjest\Builder\Instructions\Mapping\Base
 */
abstract class Mapping extends Instruction implements MappingInterface
{
    /**
     * @var string
     */
    protected $input_name;

    /**
     * If mapping is exclusive, processed value will be removed from input array
     * @var bool
     */
    protected $is_exclusive = true;

    protected $default;

    /**
     * Returns true if mapping instruction is designed for specified field.
     *
     * @param string $input_name
     * @return bool
     */
    public function isTargetInput($input_name)
    {
        return $input_name === $this->input_name;
    }

    /**
     * Returns true if mapping is exclusive.
     * Exclusivity means that processed value will be removed from input array.
     *
     * @return bool
     */
    public function isExclusive()
    {
        return $this->is_exclusive;
    }

    /**
     * Applies instruction to Scaffold.
     *
     * This method will be executed if input contains target value and it's not null
     * or there is specified default value.
     *
     * @param $value
     * @param Scaffold $scaffold
     * @return mixed
     */
    abstract protected function applyInternal($value, Scaffold $scaffold);

    public function apply(Scaffold $scaffold)
    {
        $value = $scaffold->getInput($this->input_name);
        if (null !== $value) {
            if ($this->is_exclusive) {
                $scaffold->excludeInput($this->input_name);
            }
            $this->applyInternal($value, $scaffold);
        } elseif (null !== $this->default) {
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
