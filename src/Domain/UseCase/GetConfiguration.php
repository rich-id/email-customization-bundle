<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Domain\UseCase;

use RichId\EmailCustomizationBundle\Domain\Entity\EmailConfiguration;
use RichId\EmailCustomizationBundle\Domain\Exception\NotFoundEmailConfigurationException;
use RichId\EmailCustomizationBundle\Domain\Port\ConfigurationRepositoryInterface;

class GetConfiguration
{
    /** @var ConfigurationRepositoryInterface */
    protected $configurationRepository;

    public function __construct(ConfigurationRepositoryInterface $configurationRepository)
    {
        $this->configurationRepository = $configurationRepository;
    }

    public function __invoke(string $configurationSlug): EmailConfiguration
    {
        $configuration = $this->configurationRepository->getEmailConfiguration($configurationSlug);

        if (!$configuration instanceof EmailConfiguration) {
            throw new NotFoundEmailConfigurationException($configurationSlug);
        }

        return $configuration;
    }
}
