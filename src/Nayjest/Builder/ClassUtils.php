<?php
/**
 * Created by PhpStorm.
 * User: Nayjest
 * Date: 16.02.14
 * Time: 5:00
 */

namespace Nayjest\Builder;


class ClassUtils
{
    /**
     * @param string $class
     * @param array $arguments
     * @return object
     */
    public function instantiate($class, $arguments = [])
    {
        switch (count($arguments)) {
            case 0:
                return new $class();
            case 1:
                return new $class(array_shift($arguments));
            case 2:
                return new $class(array_shift($arguments), array_shift($arguments));
            case 3:
                return new $class(array_shift($arguments), array_shift($arguments), array_shift($arguments));
            default:
                $reflection = new \ReflectionClass($class);
                return $reflection->newInstanceArgs($arguments);
        }

    }

    /**
     * @param object $instance
     * @param array $properties
     * @return array names of assigned properties
     */
    public function assignPublicProperties($instance, $properties)
    {
        $existing = get_object_vars($instance);
        $overwrite = array_intersect_key($properties, $existing);
        foreach ($overwrite as $key => $value) {
            $instance->{$key} = $value;
        }
        return array_keys($overwrite);
    }
} 