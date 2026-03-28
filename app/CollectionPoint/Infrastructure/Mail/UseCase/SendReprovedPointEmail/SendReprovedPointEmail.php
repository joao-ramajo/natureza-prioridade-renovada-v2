<?php

declare(strict_types=1);

namespace App\CollectionPoint\Infrastructure\Mail\UseCase\SendReprovedPointEmail;

use App\CollectionPoint\Infrastructure\Mail\ReprovedPointMail;
use App\CollectionPoint\Domain\CollectionPoint;
use Illuminate\Support\Facades\Mail;
use Exception;

class SendReprovedPointEmail
{
    public function execute(string $email, string $name, CollectionPoint $collectionPoint, string $reason): void
    {
        try {
            $link = config('services.npr.front_url') . '/ponto-de-coleta/' . $collectionPoint->uuid;

            Mail::to($email)->send(new ReprovedPointMail($name, $collectionPoint->name, $link, $reason));
        } catch (Exception $e) {
        }
    }
}
