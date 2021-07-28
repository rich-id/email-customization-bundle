<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Domain\UseCase;

use RichId\EmailCustomizationBundle\Domain\Entity\EmailConfiguration;
use RichId\EmailCustomizationBundle\Domain\Port\GetEntityInterface;

class GetConfigurations
{
    /** @var GetEntityInterface */
    protected $getEntity;

    public function __construct(GetEntityInterface $getEntity)
    {
        $this->getEntity = $getEntity;
    }

    /**
     * @param string|string[] $types
     *
     * @return array<string, EmailConfiguration>
     */
    public function __invoke($types = []): array
    {
        $types = (array) $types;
        $configurations = $this->getEntity->getEmailConfigurations();

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
