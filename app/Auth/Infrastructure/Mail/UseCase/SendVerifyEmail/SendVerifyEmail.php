<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Mail\UseCase\SendVerifyEmail;

use App\Auth\Domain\Entity\User;
use App\Auth\Infrastructure\Mail\VerifyEmailMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class SendVerifyEmail
{
    public function execute(User $user)
    {
        if ($user->hasVerifiedEmail()) {
            return;
        }

        $link = URL::temporarySignedRoute(
            'auth.verification.verify', // nome da rota
            now()->addMinutes(60), // expiração do link
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );
        Mail::to($user->email)->send(new VerifyEmailMail($user->name, $link));
    }
}
