<?php

declare(strict_types=1);

namespace App\Action\Mail\CollectionPoint;

use App\Mail\CollectionPoint\ContestedPointMail;
use App\Mail\CollectionPoint\PointApprovedMail;
use App\Models\CollectionPoint;
use App\Support\LogsWithContext;
use Illuminate\Support\Facades\Mail;
use Psr\Log\LoggerInterface;
use Exception;

class SendContestTutorialEmailAction
{
    use LogsWithContext;

    public function __construct(
        protected readonly LoggerInterface $logger,
    ) {
    }

    public function execute(string $email, string $name, CollectionPoint $collectionPoint): void
    {
        $this->info('Preparando email com instruções sobre contestação', [
            'collectionPointId' => $collectionPoint->id,
            'ownerEmail' => $email,
        ]);

        try {
            $link = config('services.npr.front_url') . '/ponto-de-coleta/' . $collectionPoint->uuid;

            $this->debug('Link para o ponto gerado', [
                'link' => $link,
            ]);

            Mail::to($email)->send(new ContestedPointMail($name, $collectionPoint->name, $link));

            $this->info('Email enviado com sucesso', [
                'collectionPointId' => $collectionPoint->id,
                'ownerEmail' => $email,
            ]);
        } catch (Exception $e) {
            $this->error('Erro ao enviar email', [
                'messageError' => $e->getMessage(),
                'ownerEmail' => $email,
            ]);
        }
    }
}
