<?php

namespace Adapters\Exceptions;

use Exception;

class CbrAdaterException extends Exception
{
    public function __construct(string $message = 'Error', int $code = 505, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}