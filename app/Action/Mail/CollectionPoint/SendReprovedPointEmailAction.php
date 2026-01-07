<?php

declare(strict_types=1);

namespace App\Action\Mail\CollectionPoint;

use App\Mail\CollectionPoint\ReprovedPointMail;
use App\Models\CollectionPoint;
use Illuminate\Support\Facades\Mail;

class SendReprovedPointEmailAction
{
    public function execute(string $email, string $name, CollectionPoint $cp, string $reason): void
    {
        $link = config('services.npr.front_url') . '/ponto-de-coleta/' . $cp->uuid;

        Mail::to($email)->send(new ReprovedPointMail($name, $cp->name, $link, $reason));
    }
}
