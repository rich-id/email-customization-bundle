<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Infrastructure;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use RichCongress\BundleToolbox\Configuration\AbstractBundle;
use RichId\EmailCustomizationBundle\Infrastructure\DependencyInjection\CompilerPass\AddEmailFooterPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class RichIdEmailCustomizationBundle extends AbstractBundle
{
    public const COMPILER_PASSES = [
        AddEmailFooterPass::class,
    ];

    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $this->addDoctrineOrmMappingsPass($container);
    }

    private function addDoctrineOrmMappingsPass(ContainerBuilder $container): void
    {
        if (!\class_exists(DoctrineOrmMappingsPass::class)) {
            return;
        }

        $container->addCompilerPass(
            DoctrineOrmMappingsPass::createAnnotationMappingDriver(
                ['RichId\EmailCustomizationBundle\Domain\Entity'],
                [__DIR__ . '/../Domain/Entity']
            )
        );
    }
}
