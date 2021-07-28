<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Tests\Domain\UseCase;

use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichCongress\TestSuite\TestCase\TestCase;
use RichId\EmailCustomizationBundle\Domain\UseCase\GetEmailFooter;

/**
 * @covers \RichId\EmailCustomizationBundle\Domain\UseCase\GetEmailFooter
 * @TestConfig("fixtures")
 */
final class GetEmailFooterTest extends TestCase
{
    /** @var GetEmailFooter */
    public $useCase;

    public function testUseCase(): void
    {
        $footer = ($this->useCase)();

        $this->assertStringContainsString('With kindest regards<br />', $footer);
        $this->assertStringContainsString('The test team<br />', $footer);
        $this->assertStringContainsString('Please do not reply to this email.<br />', $footer);
    }
}
