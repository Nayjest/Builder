<?php

namespace Nayjest\Builder;

class BlueptintRegistry implements BlueprintRegistryInterface
{
    protected $blueprints = [];

    protected $defaultBluePrint;

    public function __construct(BlueprintInterface $defaultBlueprint)
    {
        $this->defaultBluePrint = $defaultBlueprint;
    }

    public function get($className)
    {
        if (isset($this->blueprints[$className])) {
            return $this->blueprints[$className];
        }
        return $this->defaultBluePrint;
    }

    public function register(BlueprintInterface $blueprint, $overwrite = false)
    {
        $className = $blueprint->getClass();
        if (!$overwrite and isset($this->blueprints[$className])) {
            throw new \Exception("Trying to overwrite blueprint for '$className' in registry");
        }
        $this->blueprints[$className] = $blueprint;
    }

} 