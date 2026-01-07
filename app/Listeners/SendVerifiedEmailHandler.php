<?php

namespace App\Listeners;

use App\Action\Mail\User\SendVerifyEmailAction;
use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendVerifiedEmailHandler implements ShouldQueue
{
    public function __construct(
        protected SendVerifyEmailAction $sendEmailAction
    ) {
    }

    public function handle(UserCreated $event): void
    {
        $this->sendEmailAction->execute($event->user);
    }
}
