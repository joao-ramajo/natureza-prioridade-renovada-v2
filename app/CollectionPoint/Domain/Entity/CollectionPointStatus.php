<?php

namespace App\CollectionPoint\Domain\Entity;

enum CollectionPointStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

    /**
     * Valores para validação (request / rule)
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
