<?php
namespace Nayjest\Builder;

/**
 * Simple Builder facade implementation
 *
 * If your framework supports some kind of dependency injection,
 * it's recommended to create your own facade derived from Nayjest\Builder\Facade class
 * to avoid hardcoded dependencies and add more flexibility as result.
 *
 * This one is for simple projects to avoid overcomplicated bootstrap and use nayjest/builder functionality out of the box
 *
 * @package Nayjest\Builder
 */
class Builder extends Facade
{
    protected $artisan;

    /**
     * @var BlueprintRegistryInterface
     */
    protected $registry;
    protected $classUtils;
    protected $defaultBlueprint;

    public function __construct()
    {
        $blueprintClass = 'Nayjest\Builder\Blueprint';
        $this->classUtils = new ClassUtils();
        $this->defaultBlueprint = new Blueprint($this->classUtils);
        parent::__construct(
            $registry = new BlueptintRegistry($this->defaultBlueprint),
            new Artisan($registry),
            $blueprintClass
        );
        $this->registerBlueprintOfBlueprints();
    }

    private function registerBlueprintOfBlueprints()
    {
        $blueprintBlueprint = new Blueprint($this->classUtils);
        $blueprintBlueprint->class = $this->blueprintImplementation;
        $blueprintBlueprint->asConstructorArguments = ['classUtils'];
        $blueprintBlueprint->defaults = [
            'classUtils' => $this->classUtils
        ];
        $this->registry->register($blueprintBlueprint);
    }

    public function make($rawConfig, $class = null)
    {
        return $this->artisan->make($rawConfig, $class);
    }

    public function register($blueprint, $overwrite = false)
    {
        if (!$blueprint instanceof BlueprintInterface) {
            $blueprint = $this->make($blueprint, $this->blueprintImplementation);
        }
        $this->registry->register($blueprint, $overwrite);
    }
} 