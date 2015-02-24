<?php
namespace Nayjest\Builder\Instructions\Base;

use Nayjest\Builder\Scaffold;

interface InstructionInterface
{
    public function apply(Scaffold $scaffold);

    /**
     * @return int
     */
    public function getBuildPhase();
}