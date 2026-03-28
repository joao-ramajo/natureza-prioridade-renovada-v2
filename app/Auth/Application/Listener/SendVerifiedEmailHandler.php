<?php

namespace App\Auth\Application\Listener;

use App\Auth\Application\Event\UserCreated;
use App\Auth\Infrastructure\Mail\UseCase\SendVerifyEmail\SendVerifyEmail;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVerifiedEmailHandler implements ShouldQueue
{
    public function __construct(
        protected SendVerifyEmail $sendVerifyEmail
    ) {
    }

    public function handle(UserCreated $event): void
    {
        $this->sendVerifyEmail->execute($event->user);
    }
}
