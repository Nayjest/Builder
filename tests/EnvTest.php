<?php

namespace Nayjest\Builder\Test;

use Nayjest\Builder\Env;
use PHPUnit_Framework_TestCase;

class EnvTest extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $env = Env::instance();
        $this->assertInstanceOf('Nayjest\Builder\Env', $env);
        $this->assertInstanceOf('Nayjest\Builder\BlueprintsCollection', $env->blueprints());
    }
} 