<?php
namespace Nayjest\Builder;

use ReflectionClass;

/**
 * Class ClassUtils
 *
 * Utilities for performing manipulations with classes and objects
 *
 * @package Nayjest\Builder
 */
class ClassUtils
{
    /**
     * Creates class instance using specified constructor arguments.
     *
     * @param string $class
     * @param array $arguments
     * @return object
     */
    public static function instantiate($class, array $arguments = [])
    {
        switch (count($arguments)) {
            case 0:
                return new $class();
            case 1:
                return new $class(array_shift($arguments));
            case 2:
                return new $class(
                    array_shift($arguments),
                    array_shift($arguments)
                );
            case 3:
                return new $class(
                    array_shift($arguments),
                    array_shift($arguments),
                    array_shift($arguments)
                );
            default:
                $reflection = new ReflectionClass($class);
                return $reflection->newInstanceArgs($arguments);
        }

    }

    /**
     * Assigns values from array to existing public properties.
     *
     * @param object $instance
     * @param array $fields
     * @return string[] names of successfully assigned properties
     */
    public static function assignPublicProperties($instance, array $fields)
    {
        $existing = get_object_vars($instance);
        $overwrite = array_intersect_key($fields, $existing);
        foreach ($overwrite as $key => $value) {
            $instance->{$key} = $value;
        }
        return array_keys($overwrite);
    }

    /**
     * Assigns values from array to corresponding properties using setters.
     *
     * @param object $instance
     * @param array $fields
     * @return string[] names of successfully assigned properties
     */
    public static function assignBySetters($instance, array $fields)
    {
        $assigned_properties = [];
        foreach ($fields as $key => $value) {
            $camel_case_name = str_replace(
                ' ',
                '',
                ucwords(str_replace(array('-', '_'), ' ', $key))
            );
            $method_name = 'set' . $camel_case_name;
            if (method_exists($instance, $method_name)) {
                $instance->$method_name($value);
                $assigned_properties[] = $key;
            }
        }
        return $assigned_properties;
    }

    /**
     * Assigns values from array to object.
     *
     * @param object $instance
     * @param array $fields
     * @return string[] names of successfully assigned properties
     */
    public static function assign($instance, array $fields)
    {
        $assigned_fields = self::assignPublicProperties($instance, $fields);
        $fields = array_diff_key($fields, array_flip($assigned_fields));
        return array_merge(
            $assigned_fields,
            self::assignBySetters($instance, $fields)
        );
    }

}
