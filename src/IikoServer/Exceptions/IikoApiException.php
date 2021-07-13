<?php

namespace IikoServer\Api\Exceptions;

use Exception;

class IikoApiException extends Exception
{

    public static function loginNotProvided($loginEnvName): self {
        return new static('Required "LOGIN" not supplied in config and could not find fallback environment variable '.$loginEnvName.'');
    }

    public static function passwordNotProvided($passwordEnvName): self {
        return new static('Required "PASSWORD" not supplied in config and could not find fallback environment variable '.$passwordEnvName.'');
    }

    public static function IikoURLNotProvided($IikoUrlEnvName): self {
        return new static('Required "IIKO_HOST" not supplied in config and could not find fallback environment variable '.$IikoUrlEnvName.'');
    }

    public static function incorrectPassword($password): self {
        return new static('Password is incorrect '.$password.'');
    }

    public static function incorrectLogin($login): self {
        return new static('Login is incorrect '.$login.'');
    }

    public static function incorrectRequest(): self {
        return new static('Request failed. Check server url and parameters');
    }

    public static function incorrectBool($message): self {
        return new static('Request failed. '.$message);
    }

    public static function cardApiIncorrect(string $message){
        return new static('Request failed. '.$message);
    }
}
