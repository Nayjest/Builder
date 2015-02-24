<?php
namespace Nayjest\Builder\Mapping;
use Nayjest\Builder\Scaffold;

/**
 * Class ConstructorArgument
 * @method __construct(string $key, int $order)
 * @method setValue(int $order)
 * @method string int getValue()
 * @package Nayjest\Builder\Mapping
 */
class ConstructorArgument extends Mapping
{
    public function apply($field_value, Scaffold $scaffold)
    {
        $order = $this->getValue();
        $scaffold->constructor_arguments[$order] = $field_value;
    }
}