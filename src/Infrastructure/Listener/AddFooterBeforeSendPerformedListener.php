<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Infrastructure\Listener;

use RichId\EmailCustomizationBundle\Domain\UseCase\GetEmailFooter;

class AddFooterBeforeSendPerformedListener implements \Swift_Events_SendListener
{
    /** @var GetEmailFooter */
    protected $getEmailFooter;

    public function __construct(GetEmailFooter $getEmailFooter)
    {
        $this->getEmailFooter = $getEmailFooter;
    }

    public function beforeSendPerformed(\Swift_Events_SendEvent $event): void
    {
        $message = $event->getMessage();
        $footer = ($this->getEmailFooter)();

        $foundedFooter = \substr($message->getBody(), -\strlen($footer));

        if ($footer === '' || $message->getBody() === null || !$foundedFooter || $foundedFooter === (string) $footer) {
            return;
        }

        $newBody = $message->getBody() . $footer;

        $message
            ->setContentType('text/html')
            ->setBody($newBody);
    }

    /** @codeCoverageIgnore */
    public function sendPerformed(\Swift_Events_SendEvent $event): void
    {
    }
}
