<?php

namespace Roman\Fsm;

use Roman\Fsm\Contracts\Stateful;
use Roman\Fsm\Contracts\Transition;

class ClosureTransition implements Transition
{
    /** @var callable */
    private $closure;

    public function __construct(callable $closure)
    {

        $this->closure = $closure;
    }

    public function process(Stateful $object): void
    {
        ($this->closure)($object);
    }
}