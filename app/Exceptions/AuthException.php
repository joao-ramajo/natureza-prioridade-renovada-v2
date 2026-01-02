<?php

declare(strict_types=1);

namespace App\Exceptions;

use DomainException;

class AuthException extends DomainException
{
    public static function emailAlreadExists(): string
    {
        return "Este email não está disponivel.";
    }
}