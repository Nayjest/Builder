<?php
namespace Nayjest\Builder\Test\Mock;

class ConArgs
{
    public $a;
    public $b;
    public $c;
    protected $d;

    public function __construct($a, $b)
    {
        $this->a = "$a!a";
        $this->b = "$b!b";
    }
    public function setD($val)
    {
        $this->d = "$val!d";
    }

    /**
     * @return mixed
     */
    public function getD()
    {
        return $this->d;
    }
}