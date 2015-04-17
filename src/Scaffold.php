<?php
namespace Nayjest\Builder;

/**
 * Class Scaffold
 *
 * Scaffold stores temporary data during object building process.
 * Build instructions usually interacts with Scaffold instance.
 *
 * @package Nayjest\Builder
 */
class Scaffold
{
    /**
     * Name of target class
     * @var  string
     */
    public $class;

    /**
     * Values that will be passed to constructor or target class during build process
     * @var array
     */
    public $constructor_arguments = [];

    /**
     * @var array
     */
    public $properties = [];

    /**
     * Input data (build configuration)
     *
     * @var array|mixed
     */
    public $input = [];

    /**
     * Instance of target class
     *
     * @var object
     */
    public $instance;

    /**
     * Constructor.
     *
     * @param string $class
     * @param array|mixed $input
     */
    public function __construct($class = null, $input = [])
    {
        $this->class = $class;
        $this->input = $input;
    }

    /**
     * Removes value from input (@see $this->input)
     *
     * @param string $field_name
     */
    public function excludeInput($field_name)
    {
        unset($this->input[$field_name]);
    }

    /**
     * Retrieves value from input if exists
     *
     * @param string $key
     * @return mixed requested value or null if value not exists
     */
    public function getInput($key)
    {
        return isset($this->input[$key]) ? $this->input[$key] : null;
    }

}
