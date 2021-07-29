<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Tests\Infrastructure\Adapter;

use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichCongress\TestSuite\TestCase\TestCase;
use RichId\EmailCustomizationBundle\Domain\Entity\EmailConfiguration;
use RichId\EmailCustomizationBundle\Infrastructure\Adapter\ConfigurationRepository;

/**
 * @covers \RichId\EmailCustomizationBundle\Infrastructure\Adapter\ConfigurationRepository
 * @TestConfig("fixtures")
 */
final class ConfigurationRepositoryTest extends TestCase
{
    /** @var ConfigurationRepository */
    public $adapter;

    public function testGetEmailConfigurationConfigurationNotFound(): void
    {
        $configuration = $this->adapter->getEmailConfiguration('my_slug');
        $this->assertNull($configuration);
    }

    public function testGetEmailConfiguration(): void
    {
        $configuration = $this->adapter->getEmailConfiguration('email-footer-acknowledgement');

        $this->assertInstanceOf(EmailConfiguration::class, $configuration);

        $slug = $configuration !== null ? $configuration->getSlug() : '';
        $this->assertSame('email-footer-acknowledgement', $slug);
    }

    public function testGetEmailConfigurations(): void
    {
        $configurations = $this->adapter->getEmailConfigurations();

        $this->assertIsArray($configurations);
        $this->assertCount(3, $configurations);

        $this->assertArrayHasKey('email-footer-acknowledgement', $configurations);
        $this->assertArrayHasKey('email-footer-signature', $configurations);
        $this->assertArrayHasKey('email-footer-noreply', $configurations);
    }
}
