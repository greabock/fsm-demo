<?php


namespace Roman\Fsm\Contracts;

interface Graph
{
    public function getTransition(string $from, string $to): Transition;
}