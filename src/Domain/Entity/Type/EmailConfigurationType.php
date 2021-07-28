<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Domain\Entity\Type;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/** @extends AbstractEnumType<string> */
class EmailConfigurationType extends AbstractEnumType
{
    public const FOOTER = 'footer';

    /** @var array<string, string> */
    protected static $choices = [
        self::FOOTER => 'footer',
    ];
}
