<?php

namespace Roman\Fsm;

use Roman\Fsm\Contracts\Stateful;

class Order implements Stateful
{
    private $state = 'new';

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }
}