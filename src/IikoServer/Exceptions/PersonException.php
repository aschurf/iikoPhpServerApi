<?php


namespace IikoServer\Api\Exceptions;


class PersonException extends \Exception
{
    public static function requiredValueNotFound(string $message): self {
        return new static($message);
    }
}