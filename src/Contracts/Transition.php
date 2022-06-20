<?php

namespace Roman\Fsm\Contracts;

interface Transition
{
    public function process(Stateful $object): void;
}