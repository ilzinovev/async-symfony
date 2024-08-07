<?php

namespace App\Controller;

use App\Message\PurchaseConfirmationNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

class StockTransactionController extends AbstractController
{
    #[Route('/buy', name: 'buy-stock')]
    public function buy(MessageBusInterface $bus): Response
    {
        $order = new class() {

            public function getId()
            {
                return 1;
            }
            public function getBuyer()
            {
                return new class() {
                    public function getEmail()
                    {
                        return 'test@test.com';
                    }
                };
            }
        };
        $bus->dispatch(new PurchaseConfirmationNotification($order->getId()));

        return $this->render('stocks/example.html.twig');
    }
}