<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Infrastructure\Cache;

use RichId\EmailCustomizationBundle\Domain\Entity\EmailConfiguration;
use RichId\EmailCustomizationBundle\Infrastructure\Repository\EmailConfigurationRepository;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class EmailConfigurationCache
{
    public const CACHE_LIFETIME = 'PT1H';
    public const CACHE_KEY = 'email-configurations';

    /** @var EmailConfigurationRepository */
    protected $emailConfigurationRepository;

    /** @var CacheInterface */
    protected $cache;

    public function __construct(EmailConfigurationRepository $emailConfigurationRepository, CacheInterface $cache)
    {
        $this->emailConfigurationRepository = $emailConfigurationRepository;
        $this->cache = $cache;
    }

    /** @return array<string, EmailConfiguration> */
    public function getEmailConfigurations(): array
    {
        return $this->cache->get(
            self::CACHE_KEY,
            function (ItemInterface $item) {
                $item->expiresAfter(new \DateInterval(self::CACHE_LIFETIME));

                return $this->getSavedConfigurations();
            }
        );
    }

    public function getEmailConfiguration(string $configurationSlug): ?EmailConfiguration
    {
        $configurations = $this->getEmailConfigurations();

        return $configurations[$configurationSlug] ?? null;
    }

    public function clearCache(): void
    {
        $this->cache->delete(self::CACHE_KEY);
    }

    /** @return array<string, EmailConfiguration> */
    protected function getSavedConfigurations(): array
    {
        $results = [];
        $configurations = $this->emailConfigurationRepository->findAll();

        foreach ($configurations as $configuration) {
            $results[$configuration->getSlug()] = $configuration;
        }

        return $results;
    }
}
