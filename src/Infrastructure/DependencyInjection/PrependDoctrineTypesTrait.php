<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Infrastructure\DependencyInjection;

use RichId\EmailCustomizationBundle\Domain\Entity\Type\EmailConfigurationType;
use Symfony\Component\DependencyInjection\ContainerBuilder;

trait PrependDoctrineTypesTrait
{
    private function prependDoctrineTypes(ContainerBuilder $container): void
    {
        if (!$container->hasExtension('doctrine')) {
            return;
        }

        $doctrineConfig = $container->getExtensionConfig('doctrine');
        $doctrineDbal = \array_pop($doctrineConfig)['dbal'] ?? [];
        $doctrineDbalTypes = \array_pop($doctrineDbal)['types'] ?? [];

        $doctrineDbal['types'] = \array_merge($doctrineDbalTypes, [
            'EmailConfigurationType' => EmailConfigurationType::class,
        ]);

        $container->prependExtensionConfig(
            'doctrine',
            [
                'dbal' => $doctrineDbal,
            ]
        );
    }
}
