<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Tests\UserInterface\TwigExtension;

use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichCongress\TestSuite\TestCase\TestCase;
use RichId\EmailCustomizationBundle\Domain\Entity\EmailConfiguration;
use RichId\EmailCustomizationBundle\UserInterface\TwigExtension\EmailCustomizationExtension;
use Twig\TwigFunction;

/**
 * @covers \RichId\EmailCustomizationBundle\UserInterface\TwigExtension\EmailCustomizationExtension
 * @TestConfig("fixtures")
 */
final class EmailCustomizationExtensionTest extends TestCase
{
    /** @var EmailCustomizationExtension */
    public $extension;

    public function testExtensions(): void
    {
        $this->assertCount(3, $this->extension->getFunctions());

        $this->assertInstanceOf(TwigFunction::class, $this->extension->getFunctions()[0]);
        $this->assertInstanceOf(TwigFunction::class, $this->extension->getFunctions()[1]);
        $this->assertInstanceOf(TwigFunction::class, $this->extension->getFunctions()[2]);
    }

    public function testGetEmailConfigurationConfigurationNotFound(): void
    {
        $configuration = $this->extension->getEmailConfiguration('my_slug');
        $this->assertNull($configuration);
    }

    public function testGetEmailConfiguration(): void
    {
        $configuration = $this->extension->getEmailConfiguration('email-footer-acknowledgement');

        $this->assertInstanceOf(EmailConfiguration::class, $configuration);

        $slug = $configuration !== null ? $configuration->getSlug() : '';
        $this->assertSame('email-footer-acknowledgement', $slug);
    }

    public function testGetEmailConfigurations(): void
    {
        $configurations = $this->extension->getEmailConfigurations();

        $this->assertIsArray($configurations);
        $this->assertCount(3, $configurations);

        $this->assertArrayHasKey('email-footer-acknowledgement', $configurations);
        $this->assertArrayHasKey('email-footer-signature', $configurations);
        $this->assertArrayHasKey('email-footer-noreply', $configurations);
    }

    public function testGetEmailConfigurationValueConfigurationNotFound(): void
    {
        $value = $this->extension->getEmailConfigurationValue('my_slug');
        $this->assertNull($value);
    }

    public function testGetEmailConfigurationValue(): void
    {
        $value = $this->extension->getEmailConfigurationValue('email-footer-acknowledgement');
        $this->assertSame('With kindest regards', $value);
    }
}
