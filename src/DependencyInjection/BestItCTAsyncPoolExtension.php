<?php

namespace BestIt\CTAsyncPoolBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Loads the config for the app bundle.
 * @author lange <lange@bestit-online.de>
 * @package BestIt\CTAsyncPoolBundle
 * @subpackage DependencyInjection
 * @version $id$
 */
class BestItCTAsyncPoolExtension extends Extension
{
    /**
     * Loads the bundle config.
     * @param array $configs
     * @param ContainerBuilder $container
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $config = $this->processConfiguration(new Configuration(), $configs);

        $container->setAlias('best_it_ct_async_pool.client', $config['pool_client_id']);
    }
}
