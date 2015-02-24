<?php
namespace Nayjest\Builder\Mapping;

class Collection
{
    protected $items;
    public function __construct(array $mapping_itens)
    {
        $this->items = $mapping_itens;
    }

}