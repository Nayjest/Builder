<?php
namespace Nayjest\Builder\Instructions\Mapping;

use Nayjest\Builder\Blueprint;
use Nayjest\Builder\Builder;
use Nayjest\Builder\Instructions\Base\Instruction;
use Nayjest\Builder\Instructions\Mapping\Base\Mapping;
use Nayjest\Builder\Scaffold;

class BuildChildren extends Mapping
{
    protected $phase = Instruction::PHASE_PRE_INST;

    protected $is_exclusive = true;

    /** @var Blueprint */
    protected $blueprint;

    /**
     * Constructor.
     *
     * @param string $input_name
     * @param Blueprint $blueprint
     */
    public function __construct($input_name, Blueprint $blueprint)
    {
        $this->input_name = $input_name;
        $this->blueprint = $blueprint;
    }

    /**
     * {@inheritdoc}
     */
    public function applyInternal($value, Scaffold $scaffold)
    {
        $builder = new Builder($this->blueprint);
        $res = [];
        foreach ($value as $key => $cfg) {
            $res[$key] = $builder->build($cfg);
        }
        $scaffold->input[$this->input_name] = $res;
    }
}
