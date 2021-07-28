<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Tests\Infrastructure\Cache;

use RichCongress\TestFramework\TestConfiguration\Annotation\TestConfig;
use RichCongress\TestSuite\TestCase\TestCase;
use RichId\EmailCustomizationBundle\Domain\Entity\EmailConfiguration;
use RichId\EmailCustomizationBundle\Infrastructure\Cache\EmailConfigurationCache;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Contracts\Cache\CacheInterface;

/**
 * @covers \RichId\EmailCustomizationBundle\Infrastructure\Cache\EmailConfigurationCache
 * @TestConfig("fixtures")
 */
final class EmailConfigurationCacheTest extends TestCase
{
    /** @var EmailConfigurationCache */
    public $emailConfigurationCache;

    /** @var CacheInterface */
    public $cache;

    public function testGetEmailConfigurations(): void
    {
        /** @var ArrayAdapter $cache */
        $cache = $this->cache;

        $this->assertEmpty($cache->getValues());

        $configurations = $this->emailConfigurationCache->getEmailConfigurations();

        $this->assertIsArray($configurations);
        $this->assertCount(3, $configurations);

        $this->assertArrayHasKey('email-footer-acknowledgement', $configurations);
        $this->assertArrayHasKey('email-footer-signature', $configurations);
        $this->assertArrayHasKey('email-footer-noreply', $configurations);

        $this->assertArrayHasKey('email-configurations', $cache->getValues());
    }

    public function testGetEmailConfigurationNotFound(): void
    {
        /** @var ArrayAdapter $cache */
        $cache = $this->cache;

        $this->assertEmpty($cache->getValues());

        $configuration = $this->emailConfigurationCache->getEmailConfiguration('my_slug');

        $this->assertNull($configuration);
    }

    public function testGetEmailConfiguration(): void
    {
        /** @var ArrayAdapter $cache */
        $cache = $this->cache;

        $this->assertEmpty($cache->getValues());

        $configuration = $this->emailConfigurationCache->getEmailConfiguration('email-footer-acknowledgement');

        $this->assertInstanceOf(EmailConfiguration::class, $configuration);

        $slug = $configuration !== null ? $configuration->getSlug() : '';
        $this->assertSame('email-footer-acknowledgement', $slug);
        $this->assertArrayHasKey('email-configurations', $cache->getValues());
    }

    public function testClearCache(): void
    {
        /** @var ArrayAdapter $cache */
        $cache = $this->cache;

        $this->emailConfigurationCache->getEmailConfigurations();
        $this->assertArrayHasKey('email-configurations', $cache->getValues());

        $this->emailConfigurationCache->clearCache();
        $this->assertEmpty($cache->getValues());
    }
}
