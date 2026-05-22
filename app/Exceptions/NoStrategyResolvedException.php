<?php

namespace App\Exceptions;

class NoStrategyResolvedException extends \LogicException
{
    public function __construct(int $number)
    {
        parent::__construct('No strategy supports number '.$number);
    }
}
