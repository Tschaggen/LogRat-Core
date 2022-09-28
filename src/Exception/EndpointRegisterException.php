<?php

namespace LogRat\Core\Exception;

use Throwable;

class EndpointRegisterException extends \Exception {

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}