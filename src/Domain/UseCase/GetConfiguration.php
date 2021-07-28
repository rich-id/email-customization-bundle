<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Domain\UseCase;

use RichId\EmailCustomizationBundle\Domain\Entity\EmailConfiguration;
use RichId\EmailCustomizationBundle\Domain\Exception\NotFoundEmailConfigurationException;
use RichId\EmailCustomizationBundle\Domain\Port\GetEntityInterface;

class GetConfiguration
{
    /** @var GetEntityInterface */
    protected $getEntity;

    public function __construct(GetEntityInterface $getEntity)
    {
        $this->getEntity = $getEntity;
    }

    public function __invoke(string $configurationSlug): EmailConfiguration
    {
        $configuration = $this->getEntity->getEmailConfiguration($configurationSlug);

        if (!$configuration instanceof EmailConfiguration) {
            throw new NotFoundEmailConfigurationException($configurationSlug);
        }

        return $configuration;
    }
}
