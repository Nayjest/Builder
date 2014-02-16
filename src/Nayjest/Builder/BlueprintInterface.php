<?php
namespace Nayjest\Builder;


interface BlueprintInterface
{
    public function getClass();

    public function prepareRawConfig($data);

    public function instantiate(ObjectConfiguration $src);
} 