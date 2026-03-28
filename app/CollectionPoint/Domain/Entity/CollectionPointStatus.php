<?php

namespace App\CollectionPoint\Domain\Entity;

enum CollectionPointStatus: string
{
    case PENDING = 'avaliacao_pendente';
    case EXCLUDED = 'excluido';

    /**
     * Valores para validação (request / rule)
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
