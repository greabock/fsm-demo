<?php

namespace Roman\Fsm;

use Roman\Fsm\Contracts\Graph;
use Roman\Fsm\Contracts\Stateful;

class FSM
{
    private Graph $graph;

    public function __construct(Graph $graph)
    {
        $this->graph = $graph;
    }

    public function transit(Stateful $object, string $state): void
    {
        $transition = $this->graph->getTransition(
            $object->getState(),
            $state
        );

        $transition->process($object);
    }
}