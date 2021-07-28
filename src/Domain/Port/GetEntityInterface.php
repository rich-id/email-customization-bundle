<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Domain\Port;

use RichId\EmailCustomizationBundle\Domain\Entity\EmailConfiguration;

interface GetEntityInterface
{
    public function getEmailConfiguration(string $configurationSlug): ?EmailConfiguration;

    /** @return array<string, EmailConfiguration> */
    public function getEmailConfigurations(): array;
}
