<?php

namespace Orchestra\S3StreamBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * Configuration class determains the way the config for orchestra_s3_stream DIC
 * services are merged
 *
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 * @author David Coallier <david@orchestra.io>
 */
class Configuration implements \Symfony\Component\Config\Definition\ConfigurationInterface
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('orchestra_s3_stream', 'array');

        $rootNode
            ->children()
                ->scalarNode('access_key_id')->isRequired()->end()
                ->scalarNode('secret_access_key')->isRequired()->end()
                ->scalarNode('acl')->defaultValue('public-read')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
