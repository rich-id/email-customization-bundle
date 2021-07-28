<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Tests\Domain\UseCase;

use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichCongress\TestSuite\TestCase\TestCase;
use RichId\EmailCustomizationBundle\Domain\Entity\Type\EmailConfigurationType;
use RichId\EmailCustomizationBundle\Domain\UseCase\GetConfigurations;

/**
 * @covers \RichId\EmailCustomizationBundle\Domain\UseCase\GetConfigurations
 * @TestConfig("fixtures")
 */
final class GetConfigurationsTest extends TestCase
{
    /** @var GetConfigurations */
    public $useCase;

    public function testUseCaseWithoutFilter(): void
    {
        $configurations = ($this->useCase)();

        $this->assertIsArray($configurations);
        $this->assertCount(3, $configurations);

        $this->assertArrayHasKey('email-footer-acknowledgement', $configurations);
        $this->assertArrayHasKey('email-footer-signature', $configurations);
        $this->assertArrayHasKey('email-footer-noreply', $configurations);
    }

    public function testUseCaseFilterAllTypes(): void
    {
        $configurations = ($this->useCase)(
            [
                EmailConfigurationType::FOOTER,
            ]
        );

        $this->assertIsArray($configurations);
        $this->assertCount(3, $configurations);

        $this->assertArrayHasKey('email-footer-acknowledgement', $configurations);
        $this->assertArrayHasKey('email-footer-signature', $configurations);
        $this->assertArrayHasKey('email-footer-noreply', $configurations);
    }

    public function testUseCaseFilterOnFooter(): void
    {
        $configurations = ($this->useCase)(EmailConfigurationType::FOOTER);

        $this->assertIsArray($configurations);
        $this->assertCount(3, $configurations);

        $this->assertArrayHasKey('email-footer-acknowledgement', $configurations);
        $this->assertArrayHasKey('email-footer-signature', $configurations);
        $this->assertArrayHasKey('email-footer-noreply', $configurations);
    }
}
