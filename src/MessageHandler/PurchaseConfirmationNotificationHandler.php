<?php

namespace App\MessageHandler;

use App\Message\PurchaseConfirmationNotification;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class PurchaseConfirmationNotificationHandler
{

    public function __invoke(PurchaseConfirmationNotification $notification): void
    {
        echo 'Create pdf <br>';
        echo 'Send email ' . $notification->getOrder()->getBuyer()->getEmail() . '<br>';
    }
}