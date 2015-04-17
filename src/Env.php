<?php
namespace Nayjest\Builder;

/**
 * Class Env
 *
 * Different environments may be used to resolve conflicts
 * in builder setup.
 *
 * @package Nayjest\Builder
 */
class Env
{
    protected static $instance;

    /** @var BlueprintsCollection */
    protected $blueprints;

    /**
     * Returns default environment.
     *
     * @return self
     */
    public static function instance()
    {
        if (null === static::$instance) {
            static::$instance = new self(new BlueprintsCollection());
        }
        return static::$instance;
    }

    /**
     * Constructor.
     *
     * @param BlueprintsCollection $blueprints
     */
    public function __construct(BlueprintsCollection $blueprints)
    {
        $this->blueprints = $blueprints;
    }

    /**
     * Returns environment blueprints.
     *
     * @return BlueprintsCollection
     */
    public function blueprints()
    {
        return $this->blueprints;
    }
}
