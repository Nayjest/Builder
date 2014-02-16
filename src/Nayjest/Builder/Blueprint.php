<?php
namespace Nayjest\Builder;

/**
 * Describes how to build instances of target class.
 *
 * @package Nayjest\Builder
 */
class Blueprint implements BlueprintInterface
{
    const OPTION_CLASS = 'class';
    /**
     * Target class for ObjectBuilder
     *
     * @var string
     */
    public $class;
    public $children = [];

    /**
     * Mapping of configuration options to
     * @var array
     */
    public $mapping = [];

    /**
     * Default values for target class members
     *
     * @var array
     */
    public $defaults = [];

    /**
     * @var ClassUtils
     */
    protected $classUtils;

    public $operations = [
        'assignPublicProperties',
        'assignPublicSetters',
        'assignNonPublicProperties',
        'assign'
    ];

    public function getClass()
    {
        return $this->class;
    }

    public function instantiate(ObjectConfiguration $src)
    {
        return $this->classUtils->instantiate(
            $src->getMeta(static::OPTION_CLASS, $this->class),
            $this->getConstructorArguments($src)
        );
    }

    /**
     * @todo nor implemented yet
     * @param ObjectConfiguration $src
     * @return array
     */
    protected function getConstructorArguments(ObjectConfiguration $src)
    {
        return [];
    }

    public function __construct(ClassUtils $classUtils)
    {
        $this->classUtils = $classUtils;
    }

    public function assignPublicProperties($instance, ObjectConfiguration $src)
    {
        $assigned = $this->classUtils->assignPublicProperties($instance, $src->getRaw());
        $src->deleteAll($assigned);
    }

    public function instantiateChildren(ObjectConfiguration $src, Artisan $artisan)
    {
        foreach ($this->children as $propName => $className) {
            if ($config = $src->get($propName)) {
                $src->set($propName, $artisan->make($config, $className));
            }
        }
    }

    /**
     * Method is designed as extensibility point
     * @param $data
     * @return array
     */
    public function prepareRawConfig($data)
    {
        return $data;
    }


} 