<?php

declare(strict_types=1);

namespace App\Action\Mail\User;

use App\Mail\User\VerifyEmailMail;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class SendVerifyEmailAction
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
