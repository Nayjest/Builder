<?php
namespace Nayjest\Builder;


class ObjectConfiguration extends Configuration
{
    const OPTION_PREFIX = '@';

    protected $class;

    public function getClass($default = null)
    {
        if (!$this->class) {
            $this->class = $this->extract(static::OPTION_PREFIX . 'class', $default);
        }
        return $this->class;
    }

} 