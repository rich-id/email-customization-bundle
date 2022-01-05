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

        if ($footer === '') {
            return;
        }

        $foundedFooter = \substr($message->getBody() ?? '', -\strlen($footer));

        if ($foundedFooter !== false && $foundedFooter === $footer) {
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
