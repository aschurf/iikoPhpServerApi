<?php


namespace IikoServer\Api\Exceptions;


use Exception;

class InvoicesException extends Exception
{

    public static function getInvoicesError(string $message): self {
        return new static($message);
    }

}