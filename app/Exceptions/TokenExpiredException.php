<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TokenExpiredException extends NotFoundHttpException
{
    /**
     * @var string
     */
    protected $message = 'This link has expired or does not exist.';
}
