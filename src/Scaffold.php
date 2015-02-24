<?php
namespace Nayjest\Builder;

/**
 * Class Scaffold
 *
 * Stores temporary data during object building process
 *
 * @package Nayjest\Builder
 */
class Scaffold
{
    public $class;
    public $constructor_arguments = [];
    public $properties = [];
    public $input = [];
    public $instance;

    public function excludeInput($field_name)
    {
        unset($this->input[$field_name]);
    }

    public function getInput($key)
    {
        return isset($this->input[$key])?$this->input[$key]:null;
    }

}