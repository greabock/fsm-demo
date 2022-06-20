<?php

namespace Roman\Fsm;

use Roman\Fsm\Contracts\Graph as GraphContract;
use Roman\Fsm\Contracts\Transition;

class Graph implements GraphContract
{
    /** @var array<string,<array<string,Transition>>> */
    private array $map;

    public function __construct(array $map)
    {
        $this->map = $map;
    }

    public function getTransition(string $from, string $to): Transition
    {
        if (!isset($this->map[$to])) {
            throw new \Exception("undefined state $to");
        }

        if( !isset($this->map[$to][$from])) {
            throw new \Exception("Impossible transition from $from to $to");
        }

        return $this->map[$to][$from];
    }
}