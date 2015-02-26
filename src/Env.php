<?php
namespace Nayjest\Builder;


class Env
{
    protected static $instance;

    /** @var BlueprintsCollection */
    protected $blueprints;

    public static function instance()
    {
        if (null === static::$instance) {
            static::$instance = new self(new BlueprintsCollection());
        }
        return static::$instance;
    }

    public function __construct(BlueprintsCollection $blueprints)
    {
        $this->blueprints = $blueprints;
    }

    /**
     * @return BlueprintsCollection
     */
    public function blueprints()
    {
        return $this->blueprints;
    }



}