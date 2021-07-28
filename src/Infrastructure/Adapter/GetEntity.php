<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Infrastructure\Adapter;

use RichId\EmailCustomizationBundle\Domain\Entity\EmailConfiguration;
use RichId\EmailCustomizationBundle\Domain\Port\GetEntityInterface;
use RichId\EmailCustomizationBundle\Infrastructure\Cache\EmailConfigurationCache;

class GetEntity implements GetEntityInterface
{
    /** @var EmailConfigurationCache */
    protected $emailConfigurationCache;

    public function __construct(EmailConfigurationCache $emailConfigurationCache)
    {
        $this->emailConfigurationCache = $emailConfigurationCache;
    }

    public function getEmailConfiguration(string $configurationSlug): ?EmailConfiguration
    {
        return $this->emailConfigurationCache->getEmailConfiguration($configurationSlug);
    }

    /** @return array<string, EmailConfiguration> */
    public function getEmailConfigurations(): array
    {
        return $this->emailConfigurationCache->getEmailConfigurations();
    }
}
