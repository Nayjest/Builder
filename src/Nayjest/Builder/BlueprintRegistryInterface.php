<?php

namespace Nayjest\Builder;


interface BlueprintRegistryInterface
{

    public function register(BlueprintInterface $blueprint, $overwrite = false);

    /**
     * @param $className
     * @return BlueprintInterface
     */
    public function get($className);

} 