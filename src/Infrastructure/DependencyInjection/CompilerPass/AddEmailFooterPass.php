<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Infrastructure\DependencyInjection\CompilerPass;

use RichCongress\BundleToolbox\Configuration\AbstractCompilerPass;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

final class AddEmailFooterPass extends AbstractCompilerPass
{
    public const TYPE = PassConfig::TYPE_BEFORE_OPTIMIZATION;
    public const PRIORITY = 500;

    public function process(ContainerBuilder $container): void
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../../Resources/config'));

        $automaticAddFooterEnabled = $container->resolveEnvPlaceholders(
            $container->getParameter('rich_id_email_customization.automatic_add_footer_enabled'),
            true
        );

        if ($automaticAddFooterEnabled) {
            $loader->load('add-email-footer-services.xml');
        }
    }
}
