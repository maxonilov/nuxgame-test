<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class TokenAccessDeniedException extends AccessDeniedHttpException
{
    /**
     * @var string
     */
    protected $message = 'This link does not belong to you.';
}
