<?php

declare(strict_types=1);

namespace RichId\EmailCustomizationBundle\Infrastructure\DependencyInjection;

use RichCongress\BundleToolbox\Configuration\AbstractConfiguration;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;

class Configuration extends AbstractConfiguration
{
    public const CONFIG_NODE = 'rich_id_email_customization';

    protected function buildConfig(NodeBuilder $rootNode): void
    {
        $this->addAdminRoles($rootNode);
        $this->automaticAddFooterEnabled($rootNode);
    }

    protected function addAdminRoles(NodeBuilder $nodeBuilder): void
    {
        $nodeBuilder
            ->arrayNode('admin_roles')
            ->example(['ROLE_ADMIN'])
            ->scalarPrototype();
    }

    protected function automaticAddFooterEnabled(NodeBuilder $nodeBuilder): void
    {
        $nodeBuilder
            ->booleanNode('automatic_add_footer_enabled')
            ->defaultValue(false);
    }
}
