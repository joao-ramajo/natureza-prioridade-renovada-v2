<?php

namespace App\Enum;

enum CollectionPointStatus: string
{
    case PENDING = 'avaliacao_pendente';
    case APPROVED = 'aprovado';
    case REJECTED = 'reprovado';
    case CONTESTATION = 'em_contestacao';
    case REEVALUATION = 'em_reavaliacao';
    case EXCLUDED = 'excluido';

    /**
     * Valores para validação (request / rule)
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
