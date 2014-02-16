<?php
namespace Nayjest\Builder;

/**
 * Base facade class
 * @package Nayjest\Builder
 */
class Facade
{
    /**
     * @var Artisan
     */
    protected $artisan;

    /**
     * @var BlueprintRegistryInterface
     */
    protected $registry;

    /**
     * @var string
     */
    protected $blueprintImplementation;

    /**
     * @param Artisan $artisan
     * @param BlueprintRegistryInterface $registry
     * @param string $blueprintClass
     */
    public function __construct(
        BlueprintRegistryInterface $registry,
        Artisan $artisan,
        $blueprintClass = 'Nayjest\Builder\Blueprint'
    )
    {
        $this->registry = $registry;
        $this->artisan = $artisan;
        $this->blueprintImplementation = $blueprintClass;

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