<?php

namespace App\Message;

class PurchaseConfirmationNotification
{
    public function __construct(
        private int|string $order
    )
    {

    }

    public function getOrderId(): int|string
    {
        return $this->order;
    }
}