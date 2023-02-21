<?php
declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Throwable;

class NotAllowedCountryException extends Exception
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct("Country {$message} is not allowed to increment", $code, $previous);
    }
}
