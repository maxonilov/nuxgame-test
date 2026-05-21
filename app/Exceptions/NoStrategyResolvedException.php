<?php

namespace App\Exceptions;

class NoStrategyResolvedException extends \LogicException
{
    /**
     * @param int $number
     */
    public function __construct(int $number)
    {
        parent::__construct('No strategy supports number ' . $number);
    }
}
