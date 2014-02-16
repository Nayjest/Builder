<?php
namespace Nayjest\Builder;

class Artisan
{
    protected $registry;

    public function __construct(BlueprintRegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    public function make($rawConfig, $class = null)
    {
        if ($class) {
            $blueprint =$this->registry->get($class);
            $src = new ObjectConfiguration($blueprint->prepareRawConfig($rawConfig));
            $src->setMeta($blueprint::OPTION_CLASS, $class);
        } else {
            $src = new ObjectConfiguration($rawConfig);
            $blueprint = $this->registry->get($src->getClass());
        }

        $blueprint->provideDefaultValues($src);
        $instance  = $blueprint->instantiate($src);
        $blueprint->instantiateChildren($src, $this);
        $blueprint->assignPublicProperties($instance, $src);
        return $instance;
    }

} 