<?php

namespace Melk\ProgrTeach\MainBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class MelkProgrTeachMainExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        $loader->load('commands.yml');

        $this->setPermissionManagerInfo($config['permissions'], $container);
    }

    /**
     * Set information for permission manager
     * @param array $config
     * @param ContainerBuilder $container
     */
    public function setPermissionManagerInfo(array $config, ContainerBuilder $container){
        $permissionsManager = $container->getDefinition('melk.progr.permission.manager');

        if (isset($config['class']) && !empty($config['class']))
            $permissionsManager->addMethodCall('setEntityClass', [$config['class']]);

        foreach ($config['dependencies'] as $method) {
            $permissionsManager->addMethodCall('addDependency', [$method]);
        }

        foreach ($config['values'] as $key => $perm) {
            $permissionsManager->addMethodCall('addPermission', [$key, $perm['label'], $perm['roles']]);
        }
    }
}
