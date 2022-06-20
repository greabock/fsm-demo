<?php

namespace Roman\Fsm\Contracts;

interface Stateful
{
    public function getState(): string;

    public function setState(string $state): void;
}