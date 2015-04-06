<?php
namespace Nayjest\Builder;

/**
 * Class BlueprintsCollection
 *
 * Collection of class blueprints.
 *
 * @package Nayjest\Builder
 */
class BlueprintsCollection
{
    /** @var Blueprint[] */
    protected $items = [];

    /**
     * Adds blueprint to collection.
     *
     * @param Blueprint $blueprint
     * @return $this
     */
    public function add(Blueprint $blueprint)
    {
        $this->items[$blueprint->class] = $blueprint;
        return $this;
    }

    /**
     * Returns blueprint for specified class if exists in collection.
     *
     * If strict = false, blueprint of parent class can be returned
     *
     * @param string $class
     * @param bool $strict
     * @return Blueprint|null
     */
    public function getFor($class, $strict = false)
    {
        if (isset($this->items[$class])) {
            return $this->items[$class];
        } elseif (!$strict) {
            foreach ($this->items as $blueprint) {
                if (is_subclass_of($class, $blueprint->class, true)) {
                    return $blueprint;
                }
            }
        }
        return null;
    }
}
