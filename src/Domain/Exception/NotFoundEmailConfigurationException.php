<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Domain\Exception;

class NotFoundEmailConfigurationException extends EmailCustomizationException
{
    /** @var string */
    protected $configurationSlug;

    public function __construct(string $configurationSlug)
    {
        $this->configurationSlug = $configurationSlug;
        $message = \sprintf('Not found configuration with slug %s.', $configurationSlug);

        parent::__construct($message);
    }

    public function getConfigurationSlug(): string
    {
        return $this->configurationSlug;
    }
}
