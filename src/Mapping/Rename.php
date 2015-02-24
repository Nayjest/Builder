<?php
namespace Nayjest\Builder\Mapping;
use Nayjest\Builder\Scaffold;

/**
 * Class Rename
 * @method __construct(string $key, string $new_key)
 * @method setValue(string $new_key)
 * @method string getValue()
 * @package Nayjest\Builder\Mapping
 */
class Rename extends Mapping
{
    public function apply($field_value, Scaffold $scaffold)
    {
        $new_key = $this->getValue();
        $scaffold->properties[$new_key] = $field_value;
    }
}