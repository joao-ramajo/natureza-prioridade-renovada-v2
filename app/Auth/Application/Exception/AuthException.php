<?php

declare(strict_types=1);

namespace App\Auth\Application\Exception;

use DomainException;

class AuthException extends DomainException
{
    public static function emailAlreadExists(): string
    {
        return "Este email não está disponivel.";
    }

    public static function invalidCredentials(): string
    {
        return "Credenciais inválidas.";
    }
}
