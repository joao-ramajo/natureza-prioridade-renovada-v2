<?php

declare(strict_types=1);

namespace App\Action\Mail\CollectionPoint;

use App\Mail\CollectionPoint\PointApprovedMail;
use App\Models\CollectionPoint;
use Illuminate\Support\Facades\Mail;

class SendApprovedPointEmailAction
{
    public function execute(string $email, string $name, CollectionPoint $cp)
    {
        $link = config('services.npr.front_url') . '/ponto-de-coleta/' . $cp->uuid;

        Mail::to($email)->send(new PointApprovedMail($name, $cp->name, $link));
    }
}