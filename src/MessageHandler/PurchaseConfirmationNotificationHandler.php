<?php

namespace App\MessageHandler;

use App\Message\PurchaseConfirmationNotification;
use Mpdf\Mpdf;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;

#[AsMessageHandler]
class PurchaseConfirmationNotificationHandler
{


    public function __construct(private MailerInterface $mailer){

    }
    public function __invoke(PurchaseConfirmationNotification $notification): void
    {


        $mpdf = new Mpdf();

        $content = 'Send email ' . $notification->getOrderId() . '<br>';

        $mpdf->WriteHTML($content);
        $contractNotePdf = $mpdf->Output('', 'S');


        $email = (new Email())
            ->from('noreply@example.com')
            ->to('test@test.com')
            ->subject('Contract note for order' . $notification->getOrderId())
            ->text('Here is yor contact note')
            ->attach($contractNotePdf,  'contractNote.pdf');
        $this->mailer->send($email);
    }
}