<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\UserInterface\TwigExtension;

use RichId\EmailCustomizationBundle\Domain\Entity\EmailConfiguration;
use RichId\EmailCustomizationBundle\Domain\Exception\NotFoundEmailConfigurationException;
use RichId\EmailCustomizationBundle\Domain\UseCase\GetConfiguration;
use RichId\EmailCustomizationBundle\Domain\UseCase\GetConfigurations;
use RichId\EmailCustomizationBundle\Domain\UseCase\GetConfigurationValue;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class EmailCustomizationExtension extends AbstractExtension
{
    /** @var GetConfiguration */
    protected $getConfiguration;

    /** @var GetConfigurations */
    protected $getConfigurations;

    /** @var GetConfigurationValue */
    protected $getConfigurationValue;

    public function __construct(
        GetConfiguration $getConfiguration,
        GetConfigurations $getConfigurations,
        GetConfigurationValue $getConfigurationValue
    ) {
        $this->getConfiguration = $getConfiguration;
        $this->getConfigurations = $getConfigurations;
        $this->getConfigurationValue = $getConfigurationValue;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getEmailConfiguration', [$this, 'getEmailConfiguration']),
            new TwigFunction('getEmailConfigurations', [$this, 'getEmailConfigurations']),
            new TwigFunction('getEmailConfigurationValue', [$this, 'getEmailConfigurationValue']),
        ];
    }

    public function getEmailConfiguration(string $configurationSlug): ?EmailConfiguration
    {
        try {
            return ($this->getConfiguration)($configurationSlug);
        } catch (NotFoundEmailConfigurationException $e) {
            return null;
        }
    }

    /**
     * @param string|string[] $types
     *
     * @return array<string, EmailConfiguration>
     */
    public function getEmailConfigurations($types = []): array
    {
        return ($this->getConfigurations)($types);
    }

    public function getEmailConfigurationValue(string $configurationSlug): ?string
    {
        try {
            return ($this->getConfigurationValue)($configurationSlug);
        } catch (NotFoundEmailConfigurationException $e) {
            return null;
        }
    }
}
