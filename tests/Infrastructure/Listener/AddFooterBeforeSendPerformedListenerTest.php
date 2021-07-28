<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Tests\Infrastructure\Listener;

use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichCongress\TestSuite\TestCase\TestCase;
use RichId\EmailCustomizationBundle\Infrastructure\Listener\AddFooterBeforeSendPerformedListener;
use RichId\EmailCustomizationBundle\Tests\Resources\Stubs\GetEmailFooterStub;

/**
 * @covers \RichId\EmailCustomizationBundle\Infrastructure\Listener\AddFooterBeforeSendPerformedListener
 * @TestConfig("fixtures")
 */
final class AddFooterBeforeSendPerformedListenerTest extends TestCase
{
    /** @var AddFooterBeforeSendPerformedListener */
    protected $listener;

    /** @var GetEmailFooterStub */
    public $getEmailFotterStub;

    public function beforeTest(): void
    {
        $this->listener = new AddFooterBeforeSendPerformedListener($this->getEmailFotterStub);
    }

    public function testListener(): void
    {
        $this->assertInstanceOf(\Swift_Events_SendListener::class, $this->listener);
    }

    public function testBeforeSendPerformedWithEmptyFooter(): void
    {
        $this->getEmailFotterStub->setFooter('');

        $message = new \Swift_Message();
        $event = new \Swift_Events_SendEvent(
            new \Swift_NullTransport(),
            $message
        );

        $this->listener->beforeSendPerformed($event);

        $this->assertNull($message->getBody());
        $this->assertSame('text/plain', $message->getContentType());
    }

    public function testBeforeSendPerformed(): void
    {
        $this->getEmailFotterStub->setFooter('My content');

        $message = new \Swift_Message();
        $event = new \Swift_Events_SendEvent(
            new \Swift_NullTransport(),
            $message
        );

        $this->listener->beforeSendPerformed($event);

        $this->assertSame('My content', $message->getBody());
        $this->assertSame('text/html', $message->getContentType());
    }
}
