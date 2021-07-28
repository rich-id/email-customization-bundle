<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Domain\UseCase;

class GetConfigurationValue
{
    /** @var GetConfiguration */
    protected $getConfiguration;

    public function __construct(GetConfiguration $getConfiguration)
    {
        $this->getConfiguration = $getConfiguration;
    }

    public function __invoke(string $configurationSlug): ?string
    {
        $configuration = ($this->getConfiguration)($configurationSlug);

        return $configuration->getValueToUse();
    }
}
