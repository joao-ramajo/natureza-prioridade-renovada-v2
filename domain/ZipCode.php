<?php declare(strict_types=1);

namespace Domain;

use InvalidArgumentException;

class ZipCode
{
    public readonly string $value;

    public function __construct(string $value)
    {
        $this->validate($value);

        $this->value = $this->normalize($value);
    }

    public static function create(string | int $value): ZipCode
    {
        return new self($value);
    }

    private function validate(string $value): void
    {
        if (!preg_match('/^\d{5}-?\d{3}$/', $value)) {
            throw new InvalidArgumentException("CEP inválido: {$value}");
        }
    }

    private function normalize(string $value): string
    {
        // Remove qualquer hífen e formata como 12345-678
        $digits = str_replace('-', '', $value);
        return substr($digits, 0, 5) . '-' . substr($digits, 5, 3);
    }

    /**
     * Retorna o CEP apenas com dígitos (sem hífen)
     */
    public function getRaw(): string
    {
        return str_replace('-', '', $this->value);
    }
}
