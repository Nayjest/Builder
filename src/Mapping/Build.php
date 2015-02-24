<?php
namespace Nayjest\Builder\Mapping;
use Nayjest\Builder\Blueprint;
use Nayjest\Builder\Builder;
use Nayjest\Builder\Scaffold;

/**
 * Class Build
 * @method __construct(string $key, Builder $builder)
 * @method setValue(Builder $builder)
 * @method string Builder getValue()
 * @package Nayjest\Builder\Mapping
 */
class Build extends Mapping
{
    public function apply($field_value, Scaffold $scaffold)
    {
        $key = $this->getKey();
        $builder = $this->getValue();
        $scaffold->properties[$key] = $builder->build($field_value);
    }
}