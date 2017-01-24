<?php

namespace BestIt\CTAsyncPoolBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration class for this bundle.
 * @author blange <lange@bestit-online.de>
 * @package BestIt\CTAsyncPoolBundle
 * @subpackage DependencyInjection
 * @version $id$
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Parses the config.
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();

        $builder->root('best_it_ct_async_pool')
            ->children()
                ->scalarNode('pool_client_id')->info('Which commercetools client should be used?') ->isRequired()->end()
            ->end();

        return $builder;
    }
}
