<?php

declare(strict_types=1);

namespace App\CollectionPoint\Infrastructure\Mail\UseCase\SendApprovedPointEmail;

use App\CollectionPoint\Infrastructure\Mail\PointApprovedMail;
use App\CollectionPoint\Domain\CollectionPoint;
use Illuminate\Support\Facades\Mail;
use Exception;

class SendApprovedPointEmail
{
    public function execute(string $email, string $name, CollectionPoint $collectionPoint): void
    {
        try {
            $link = config('services.npr.front_url') . '/ponto-de-coleta/' . $collectionPoint->uuid;

            Mail::to($email)->send(new PointApprovedMail($name, $collectionPoint->name, $link));
        } catch (Exception $e) {
        }
    }
}
