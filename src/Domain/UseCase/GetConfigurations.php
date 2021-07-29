<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Domain\UseCase;

use RichId\EmailCustomizationBundle\Domain\Entity\EmailConfiguration;
use RichId\EmailCustomizationBundle\Domain\Port\ConfigurationRepositoryInterface;

class GetConfigurations
{
    /** @var ConfigurationRepositoryInterface */
    protected $configurationRepository;

    public function __construct(ConfigurationRepositoryInterface $configurationRepository)
    {
        $this->configurationRepository = $configurationRepository;
    }

    /**
     * @param string|string[] $types
     *
     * @return array<string, EmailConfiguration>
     */
    public function __invoke($types = []): array
    {
        $types = (array) $types;
        $configurations = $this->configurationRepository->getEmailConfigurations();

        if (empty($types)) {
            return $configurations;
        }

        return \array_filter(
            $configurations,
            static function (EmailConfiguration $emailConfiguration) use ($types) {
                return \in_array($emailConfiguration->getType(), $types, true);
            }
        );
    }
}
